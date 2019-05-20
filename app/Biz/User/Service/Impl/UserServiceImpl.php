<?php

namespace App\Biz\User\Service\Impl;

use App\Biz\User\Service\UserService;
use App\Biz\BaseService;
use App\Biz\User\Dao\UserDao;

class UserServiceImpl extends BaseService implements UserService
{
    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUser($id)
    {
        return $this->getUserDao()->get($id);
    }

    /**
     * @param $conditions
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function countUsers($conditions)
    {
        $conditions = $this->prepareConditions($conditions);

        return $this->getUserDao()->count($conditions);
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function searchUsers($conditions, $orderBy, $offset, $limit)
    {
        $conditions = $this->prepareConditions($conditions);

        return $this->getUserDao()->search($conditions, $orderBy, $offset, $limit);
    }

    public function isEmailAvailable($email, $exclude = null)
    {
        // TODO: Implement isEmailAvailable() method.
    }

    public function isMobileAvailable($mobile, $exclude = null)
    {
        // TODO: Implement isMobileAvailable() method.
    }

    public function isNicknameAvailable($nickname, $exclude = null)
    {
        // TODO: Implement isNicknameAvailable() method.
    }

    /**
     * @param $conditions
     * @return array
     */
    protected function prepareConditions($conditions)
    {
        $conditions = array_filter($conditions, function($value) {
            if (0 == $value) {
                return true;
            }

            return !empty($value);
        });

        return $conditions;
    }

    /**
     * @return UserDao
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserDao()
    {
        return $this->createDao('User:UserDao');
    }
}
