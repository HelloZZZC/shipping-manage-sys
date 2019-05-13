<?php

namespace App\Biz\User\Dao\Impl;

use App\Biz\User\Dao\UserDao;
use App\Models\User;

class UserDaoImpl implements UserDao
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return User::where('id', $id)->first();
    }
}
