<?php

namespace App\Biz\User\Service\Impl;

use App\Biz\User\Service\UserService;
use App\Biz\BaseService;
use App\Biz\User\Dao\UserDao;
use App\Common\Exception\InvalidArgumentException;
use App\Common\Utils\ArrayUtil;

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

    /**
     * @param $email
     * @param null $exclude
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function isEmailAvailable($email, $exclude = null)
    {
        if (empty($email)) {
            return false;
        }

        if ($email == $exclude) {
            return true;
        }

        $user = $this->getUserDao()->getByEmail($email);

        return empty($user);
    }

    /**
     * @param $mobile
     * @param null $exclude
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function isMobileAvailable($mobile, $exclude = null)
    {
        if (empty($mobile)) {
            return false;
        }

        if ($mobile == $exclude) {
            return true;
        }

        $user = $this->getUserDao()->getByMobile($mobile);

        return empty($user);
    }

    /**
     * @param $nickname
     * @param null $exclude
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function isNicknameAvailable($nickname, $exclude = null)
    {
        if (empty($nickname)) {
            return false;
        }

        if ($nickname == $exclude) {
            return true;
        }

        $user = $this->getUserDao()->getByNickname($nickname);

        return empty($user);
    }

    /**
     * @param $registration
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function isUserRegistrationAvailable($registration)
    {
        if (!ArrayUtil::requireds($registration, ['nickname', 'email', 'password', 'verified_mobile'])) {
            return false;
        }

        $conditions = [
            'nickname' => $registration['nickname'],
            'or_email' => $registration['email'],
            'or_verified_mobile' => $registration['verified_mobile'],
        ];
        $count = $this->getUserDao()->count($conditions);

        return !$count;
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $limit
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function pagingUsers($conditions, $orderBy, $limit)
    {
        $conditions = $this->prepareConditions($conditions);

        return $this->getUserDao()->paging($conditions, $orderBy, $limit);
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
