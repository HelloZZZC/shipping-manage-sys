<?php

namespace App\Http\Controllers;

use App\Biz\Auth\Service\AuthService;
use App\Biz\File\Service\FileService;
use App\Biz\Role\Service\RoleService;
use App\Biz\User\Service\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Biz\User\Service\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Common\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Hash;
use App\Biz\Importer\ImporterFactory;
use Illuminate\Support\Facades\Log;
use App\Common\Utils\RoleUtil;

class UserController extends Controller
{
    use BizAutoload;

    /**
     * 用户管理页面渲染
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request)
    {
        $default = [
            'with_deleted' => true,
        ];
        $conditions = $request->query->all();
        $conditions = array_merge($default, $conditions);

        $count = $this->getUserService()->countUsers($conditions);
        $users = $this->getUserService()->pagingUsers($conditions, ['id', 'desc'], 10);

        return view('user.user', [
            'users' => $users,
            'count' => $count,
        ]);
    }

    /**
     * 新增用户
     * @param Request $request
     * @return UserController|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws InvalidArgumentException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create(Request $request)
    {
        if ('POST' == $request->getMethod()) {
            $rules = $this->getUserRules();
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new InvalidArgumentException('非法提交');
            }

            $registration = $this->buildRegistration($validator->validated());
            $this->getAuthService()->register($registration);

            return $this->createJsonResponse([], 0, '用户创建成功');
        }

        return view('user.modal');
    }

    /**
     * 检查nickname是否非法
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function checkNickname(Request $request)
    {
        $value = $request->query->get('nickname');

        $result = $this->getUserService()->isNicknameAvailable($value);

        return JsonResponse::create($result);
    }

    /**
     * 检查mobile是否非法
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function checkMobile(Request $request)
    {
        $value = $request->query->get('mobile');
        $exclude = $request->query->get('exclude');
        $exclude = empty($exclude) ? null : $exclude;

        $result = $this->getUserService()->isMobileAvailable($value, $exclude);

        return JsonResponse::create($result);
    }

    /**
     * 检查email是否非法
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function checkEmail(Request $request)
    {
        $value = $request->query->get('email');
        $exclude = $request->query->get('exclude');
        $exclude = empty($exclude) ? null : $exclude;

        $result = $this->getUserService()->isEmailAvailable($value, $exclude);

        return JsonResponse::create($result);
    }

    /**
     * 显示用户导入Modal
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userImporterShow()
    {
        return view('user.importer-modal');
    }

    /**
     * 导入用户
     * @param Request $request
     * @return UserController
     */
    public function userImport(Request $request)
    {
        try {
            $file = $request->file('file');
            $importer = ImporterFactory::createFactory('user');
            $importer->import($file);
            $importMsg = $importer->getImportMessage();
        } catch (\Throwable $t) {
            Log::error($t->getMessage(), ['code' => $t->getCode(), 'trace' => $t->getTraceAsString()]);
            return $this->createJsonResponse([
                'progress' => 90,
            ], 500);
        }

        return $this->createJsonResponse([
            'progress' => 100,
            'importMsg' => $importMsg,
        ], 0);
    }

    /**
     * 用户个人主页渲染
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function homepage($id)
    {
        $user = $this->getUserService()->getUser($id);
        $profile = $this->getUserProfileService()->getUserProfile($id);
        $userRole = $user->getRoleNames()->toArray();

        return view('user.homepage', [
            'user' => $user,
            'profile' => $profile,
            'role' => RoleUtil::transRole($userRole[0]),
        ]);
    }

    /**
     * 头像上传
     * @param Request $request
     * @return UserController
     */
    public function uploadAvatar(Request $request)
    {
        $tmpAvatar = $request->file('file');
        $avatarPath = Storage::putFile('public/files/tmp', $tmpAvatar);
        $absolutePath = storage_path().'/app/'.$avatarPath;

        if (!is_file($absolutePath)) {
            return $this->createJsonResponse([], 500, '服务器保存头像失败');
        }
        $avatarLink = str_replace('public/', '', $avatarPath);

        return $this->createJsonResponse(
            ['avatar_url' => $avatarLink, 'goto_url' => route('user_avatar_crop')],
            0,
            '头像保存成功'
        );
    }

    /**
     * 头像切割
     * @param Request $request
     * @return UserController|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function cropAvatar(Request $request)
    {
        $user = Auth::user();
        $avatarUrl = $request->query->get('avatar_url');
        if ('POST' == $request->getMethod()) {
            $avatar = $request->file('crop_avatar');
            $tmpAvatar = $request->request->get('tmp_avatar');
            $this->getUserService()->changeAvatar($user->id, $avatar);
            $this->getFileService()->remove(storage_path().'/app/'.$tmpAvatar);
            return $this->createJsonResponse([], 0, '头像保存成功过');
        }

        return view('user.crop-modal', [
            'avatar_url' => $avatarUrl
        ]);
    }

    /**
     * 将用户设置成离职状态
     * @param $id
     * @return UserController
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function lockUser($id)
    {
        $this->getUserService()->lockUser($id);

        return $this->createJsonResponse([] , 0, '封禁用户成功');
    }

    /**
     * 解除用户离职状态
     * @param $id
     * @return UserController
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function unlockUser($id)
    {
        $this->getUserService()->unlockUser($id);

        return $this->createJsonResponse([] , 0, '解除封禁用户成功');
    }

    /**
     * 修改用户密码
     * @param Request $request
     * @param $id
     * @return UserController|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function changePassword(Request $request, $id)
    {
        $user = $this->getUserService()->getUser($id);

        if ('POST' == $request->getMethod()) {
            $fields = $request->request->all();
            $this->getUserService()->changeUserPassword($id, $fields);
            return $this->createJsonResponse([], 0, '修改密码成功');
        }

        return view('user.password-change-modal', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return UserController|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws InvalidArgumentException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function changeRole(Request $request, $id)
    {
        $user = $this->getUserService()->getUser($id);
        $currentRole = $user->getRoleNames()->toArray()[0];
        $roles = $this->getRoleService()->findAll();
        $roleMap = RoleUtil::roleMap();

        if ('POST' == $request->getMethod()) {
            $rules = $this->getUserRules();
            $validator = Validator::make($request->all(), ['role' => 'required']);
            if ($validator->fails()) {
                throw new InvalidArgumentException('非法提交');
            }
            $validated = $validator->validated();
            $this->getUserService()->changeRole($id, $validated['role']);
            return $this->createJsonResponse([], 0, '修改用户角色成功');
        }

        return view('user.change-role-modal', [
            'user' => $user,
            'current_role' => $currentRole,
            'roles' => $roles,
            'map' => $roleMap,
        ]);
    }

    /**
     * 构建注册所需要的参数
     * @param $registration
     * @return mixed
     */
    protected function buildRegistration($registration)
    {
        $registration['verified_mobile'] = $registration['mobile'];
        $registration['password'] = Hash::make($registration['password']);
        /**
         * 去掉无用字段
         */
        unset($registration['mobile']);
        unset($registration['confirm_password']);

        return $registration;
    }

    /**
     * 获取用户创建规则
     * @return array
     */
    protected function getUserRules()
    {
        return [
            'nickname' => 'required|alpha_num',
            'password' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'confirm_password' => 'required|same:password'
        ];
    }

    /**
     * @return RoleService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getRoleService()
    {
        return $this->createService('Role:RoleService');
    }

    /**
     * @return FileService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getFileService()
    {
        return $this->createService('File:FileService');
    }

    /**
     * @return UserProfileService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserProfileService()
    {
        return $this->createService('User:UserProfileService');
    }

    /**
     * @return AuthService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getAuthService()
    {
        return $this->createService('Auth:AuthService');
    }

    /**
     * @return UserService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserService()
    {
        return $this->createService('User:UserService');
    }
}
