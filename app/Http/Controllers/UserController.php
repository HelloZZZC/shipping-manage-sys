<?php

namespace App\Http\Controllers;

use App\Biz\Auth\Service\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Biz\User\Service\UserService;
use Illuminate\Support\Facades\Validator;
use App\Common\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Hash;
use App\Biz\Importer\ImporterFactory;
use Illuminate\Support\Facades\Log;

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
        $result = $this->getUserService()->isMobileAvailable($value);

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
        $result = $this->getUserService()->isEmailAvailable($value);

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
