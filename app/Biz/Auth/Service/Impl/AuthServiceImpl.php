<?php

namespace App\Biz\Auth\Service\Impl;

use App\Biz\Auth\Service\AuthService;
use App\Biz\User\Service\UserProfileService;
use App\Biz\User\Service\UserService;
use Illuminate\Support\Facades\DB;
use App\Biz\BaseService;

class AuthServiceImpl extends BaseService implements AuthService
{
    /**
     * @param $user
     * @return mixed
     * @throws \Throwable
     */
    public function register($user)
    {
        try {
            DB::beginTransaction();
            $this->getUserService()->createUser($user);
            $this->getUserProfileService()->createUserProfile(['gender' => 'secret']);
            $user = $this->getUserService()->getUserByNickname($user['nickname']);
            $user->assignRole('user');
            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            throw $t;
        }
        return $user;
    }

    /**
     * @return UserService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserService()
    {
        return $this->createService('User:UserService');
    }

    /**
     * @return UserProfileService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserProfileService()
    {
        return $this->createService('User:UserProfileService');
    }
}
