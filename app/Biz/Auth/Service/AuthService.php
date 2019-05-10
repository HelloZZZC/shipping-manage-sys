<?php

namespace App\Biz\Auth\Service;

interface AuthService
{
    /**
     * 注册用户
     * @param $user
     * @return mixed
     */
    public function register($user);
}
