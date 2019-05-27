<?php

namespace App\Common\Utils;

class RoleUtil
{
    /**
     * 将用户角色转换成英文
     * @TODO 可以改成通过i18n进行转换
     * @param $role
     * @return mixed
     */
    public static function transRole($role)
    {
        $roleMap = self::roleMap();

        return $roleMap[$role];
    }

    public static function roleMap()
    {
        return [
            'user' => '普通用户',
            'admin' => '管理员',
            'superAdmin' => '超级管理员',
        ];
    }
}
