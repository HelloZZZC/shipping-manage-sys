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

    public static function transPermission($permission)
    {
        $permissionMap = self::permissionMap();

        return $permissionMap[$permission];
    }

    public static function roleMap()
    {
        return [
            'user' => '普通用户',
            'admin' => '管理员',
            'superAdmin' => '超级管理员',
        ];
    }

    public static function permissionMap()
    {
        return [
            'viewHomepage' => '首页',
            'viewRoster' => '花名册',
            'viewShipping' => '价格计算器',
            'viewUser' => '员工',
            'viewRole' => '角色',
            'viewSetting' => '设置',
            'viewImporter' => '导入数据',
        ];
    }
}
