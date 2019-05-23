<?php

namespace App\Biz\User\Service\Impl;

use App\Biz\BaseService;
use App\Biz\User\Dao\UserProfileDao;
use App\Biz\User\Service\UserProfileService;

class UserProfileServiceImpl extends BaseService implements UserProfileService
{
    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUserProfile($id)
    {
        return $this->getUserProfileDao()->get($id);
    }

    /**
     * @param $userProfile
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function createUserProfile($userProfile)
    {
        return $this->getUserProfileDao()->create($userProfile);
    }

    /**
     * @param $id
     * @param $profile
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function updateUserProfile($id, $profile)
    {
        return $this->getUserProfileDao()->update($id, $profile);
    }

    /**
     * @return UserProfileDao
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserProfileDao()
    {
        return $this->createDao('User:UserProfileDao');
    }
}
