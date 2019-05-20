<?php

namespace App\Biz\User\Dao;

interface UserDao
{
    /**
     * 获取单个用户
     * @param $id
     * @return mixed
     */
    public function get($id);

    /**
     * @param $conditions
     * @return mixed
     */
    public function count($conditions);

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function search($conditions, $orderBy, $offset, $limit);

    /**
     * @param $email
     * @return mixed
     */
    public function getByEmail($email);

    /**
     * @param $nickname
     * @return mixed
     */
    public function getByNickname($nickname);

    /**
     * @param $mobile
     * @return mixed
     */
    public function getByMobile($mobile);
}

