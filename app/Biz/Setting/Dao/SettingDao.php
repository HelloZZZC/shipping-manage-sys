<?php

namespace Biz\Setting\Dao;

interface SettingDao
{
    /**
     * 根据名称获取系统配置
     * @param $name
     * @return mixed
     */
    public function getByName($name);

    /**
     * 根据配置名称删除系统设置
     * @param $name
     * @return mixed
     */
    public function deleteByName($name);

    /**
     * 插入一条系统配置
     * @param $setting
     * @return mixed
     */
    public function create($setting);
}
