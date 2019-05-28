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
        $profile = array_filter($profile, function($value) {
            if (0 === $value) {
                return true;
            }

            return !empty($value);
        });

        $default = [
            'real_name' => '',
            'age' => null,
            'gender' => 'secret',
            'address' => '',
            'graduation' => '',
            'birthday' => '',
            'qq' => '',
            'wechat' => '',
            'job' => '',
            'about' => '',
        ];
        $profile = array_merge($default, $profile);
        return $this->getUserProfileDao()->update($id, $profile);
    }

    /**
     * @param $ids
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function findUserProfilesByIds($ids)
    {
        return $this->getUserProfileDao()->findByIds($ids);
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
