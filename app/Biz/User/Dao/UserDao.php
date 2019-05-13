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
}

