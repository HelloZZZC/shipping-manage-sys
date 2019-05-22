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
        $offset = (int) $offset;
        $limit = (int) $limit;

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
     * @param $orderBy
     * @param $limit
     * @return mixed
     */
    public function paging($conditions, $orderBy, $limit)
    {
        $limit = (int) $limit;

        $stmt = User::select('*');

        return $this->buildQueryStatement($conditions, $stmt)->orderBy($orderBy[0], $orderBy[1])->paginate($limit);
    }

    /**
     * @param $user
     * @return mixed
     */
    public function create($user)
    {
        return User::insert($user);
    }

    /**
     * @param $conditions
     * @param $stmt
     * @return mixed
     */
    protected function buildQueryStatement($conditions, $stmt)
    {
        if (isset($conditions['with_deleted']) && $conditions['with_deleted']) {
            $stmt = $stmt->withTrashed();
        }
        if (isset($conditions['only_deleted']) && $conditions['only_deleted']) {
            $stmt = $stmt->onlyTrashed();
        }
        if (isset($conditions['nickname'])) {
            $stmt = $stmt->where('nickname', $conditions['nickname']);
        }
        if (isset($conditions['or_email'])) {
            $stmt = $stmt->orWhere('email', $conditions['or_email']);
        }
        if (isset($conditions['or_verified_mobile'])) {
            $stmt = $stmt->orWhere('verified_mobile', $conditions['or_verified_mobile']);
        }
        if (isset($conditions['like_nickname'])) {
            $stmt = $stmt->where('nickname', 'like', '%'.$conditions['like_nickname'].'%');
        }
        if (isset($conditions['like_email'])) {
            $stmt = $stmt->where('email', 'like', '%'.$conditions['like_email'].'%');
        }
        if (isset($conditions['like_verified_mobile'])) {
            $stmt = $stmt->where('verified_mobile', 'like', '%'.$conditions['like_verified_mobile'].'%');
        }

        return $stmt;
    }
}
