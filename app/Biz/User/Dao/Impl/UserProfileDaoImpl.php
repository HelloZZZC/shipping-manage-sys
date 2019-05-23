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
        return UserProfile::create($userProfile);
    }

    /**
     * @param $id
     * @param $profile
     * @return mixed
     */
    public function update($id, $profile)
    {
        return UserProfile::where('id', $id)->update($profile);
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function findByIds($ids)
    {
        return UserProfile::whereIn('id', $ids)->get();
    }
}
