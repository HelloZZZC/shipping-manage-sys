<?php

namespace App\Biz\User\Service\Impl;

use App\Biz\User\Service\UserService;

class UserServiceImpl implements UserService
{
    public function getUser($id)
    {
        return [
            'nickname' => '开发者',
            'age' => 25,
        ];
    }
}
