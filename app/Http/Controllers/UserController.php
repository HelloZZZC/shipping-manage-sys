<?php

namespace App\Http\Controllers;

use App\Biz\Auth\Service\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Biz\User\Service\UserService;
use Illuminate\Support\Facades\Validator;
use App\Common\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use BizAutoload;

    public function index(Request $request)
    {
        $conditions = $request->query->all();

        $count = $this->getUserService()->countUsers($conditions);
        $users = $this->getUserService()->searchUsers($conditions, ['id', 'desc'], 0, $count);

        return view('user.user', [
            'count' => $count,
            'users' => $users->toArray(),
        ]);
    }

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

    public function checkNickname(Request $request)
    {
        $value = $request->query->get('nickname');
        $result = $this->getUserService()->isNicknameAvailable($value);

        return JsonResponse::create($result);
    }

    public function checkMobile(Request $request)
    {
        $value = $request->query->get('mobile');
        $result = $this->getUserService()->isMobileAvailable($value);

        return JsonResponse::create($result);
    }

    public function checkEmail(Request $request)
    {
        $value = $request->query->get('email');
        $result = $this->getUserService()->isEmailAvailable($value);

        return JsonResponse::create($result);
    }

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
