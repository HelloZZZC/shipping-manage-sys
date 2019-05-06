<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    use BizAutoload;

    /**
     * 获取用户
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $user = $this->getUserService()->getUser(1);
        var_dump($user);
        exit();
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserService()
    {
        return $this->createService('User:UserService');
    }
}
