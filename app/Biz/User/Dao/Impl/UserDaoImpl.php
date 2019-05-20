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

    /**
     * @param $conditions
     * @return mixed
     */
    public function count($conditions)
    {
        $stmt = User::select('*');

        return $this->buildQueryStatement($conditions, $stmt)->count();
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed\
     */
    public function search($conditions, $orderBy, $offset, $limit)
    {
        $stmt = User::select('*');

        return $this->buildQueryStatement($conditions, $stmt)->orderBy($orderBy[0], $orderBy[1])->offset($offset)->limit($limit)->get();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param $mobile
     * @return mixed
     */
    public function getByMobile($mobile)
    {
        return User::where('verified_mobile', $mobile)->first();
    }

    /**
     * @param $nickname
     * @return mixed
     */
    public function getByNickname($nickname)
    {
        return User::where('nickname', $nickname)->first();
    }

    /**
     * @param $conditions
     * @param $stmt
     * @return mixed
     */
    protected function buildQueryStatement($conditions, $stmt)
    {
        if (isset($conditions['without_deleted']) && $conditions['without_deleted']) {
            $stmt = $stmt->withTrashed();
        }

        return $stmt;
    }
}
