<?php

namespace App\Biz\User\Service;

interface UserProfileService
{
    /**
     * 获取用户简介
     * @param $id
     * @return mixed
     */
    public function getUserProfile($id);

    /**
     * 创建用户简介
     * @param $profile
     * @return mixed
     */
    public function crateUserProfile($profile);
}
