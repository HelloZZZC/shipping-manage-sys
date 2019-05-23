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
    public function createUserProfile($profile);

    /**
     * 更新用户简介
     * @param $id
     * @param $profile
     * @return mixed
     */
    public function updateUserProfile($id, $profile);

    /**
     * 根据id获取用户简介数组
     * @param $ids
     * @return mixed
     */
    public function findUserProfilesByIds($ids);
}
