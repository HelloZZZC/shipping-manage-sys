<?php

namespace App\Biz\User\Service;

interface UserService
{
    /**
     * 获取单个用户
     * @param $id
     * @return mixed
     */
    public function getUser($id);
}
