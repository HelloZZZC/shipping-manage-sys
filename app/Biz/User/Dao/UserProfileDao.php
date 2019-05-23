<?php

namespace App\Biz\User\Dao;

interface UserProfileDao
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id);

    /**
     * @param $userProfile
     * @return mixed
     */
    public function create($userProfile);

    /**
     * @param $id
     * @param $profile
     * @return mixed
     */
    public function update($id, $profile);
}
