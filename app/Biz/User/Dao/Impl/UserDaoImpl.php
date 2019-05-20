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

    public function search($conditions, $orderBy, $offset, $limit)
    {
        $stmt = User::select('*');

        return $this->buildQueryStatement($conditions, $stmt)->orderBy($orderBy[0], $orderBy[1])->offset($offset)->limit($limit)->get();
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
