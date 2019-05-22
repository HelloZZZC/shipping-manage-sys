<?php

namespace App\Biz\User\Dao\Impl;

use App\Biz\User\Dao\UserProfileDao;
use App\Models\UserProfile;

class UserProfileDaoImpl implements UserProfileDao
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return UserProfile::where('id', $id)->first();
    }

    /**
     * @param $userProfile
     * @return mixed
     */
    public function create($userProfile)
    {
        return UserProfile::insert($userProfile);
    }
}
