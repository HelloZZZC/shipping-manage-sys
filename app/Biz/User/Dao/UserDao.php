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
}

