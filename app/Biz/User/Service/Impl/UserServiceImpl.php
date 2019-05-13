<?php

namespace App\Biz\User\Service\Impl;

use App\Biz\User\Service\UserService;
use App\Biz\BaseService;
use App\Biz\User\Dao\UserDao;

class UserServiceImpl extends BaseService implements UserService
{
    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUser($id)
    {
        return $this->getUserDao()->get($id);
    }

    /**
     * @return UserDao
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserDao()
    {
        return $this->createDao('User:UserDao');
    }
}
