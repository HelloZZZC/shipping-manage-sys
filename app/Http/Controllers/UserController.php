<?php

namespace App\Http\Controllers;

use App\Biz\Auth\Service\AuthService;
use Illuminate\Http\Request;
use App\Biz\User\Service\UserService;
use Illuminate\Support\Facades\Validator;
use App\Common\Exception\InvalidArgumentException;

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
            $this->getAuthService()->register($validator->validated());

            return $this->createJsonResponse([], 0, '用户创建成功');
        }

        return view('user.modal');
    }

    public function checkNickname(Request $request)
    {

    }

    public function checkMobile(Request $request)
    {

    }

    public function checkEmail(Request $request)
    {

    }

    protected function getUserRules()
    {
        return [
            'nickname' => 'required',
            'password' => 'required',
            'email' => 'required',
            'verified_mobile' => 'required',
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
