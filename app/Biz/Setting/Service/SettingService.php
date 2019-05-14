<?php

namespace App\Biz\Setting\Service;

interface SettingService
{
    /**
     * 设置系统配置
     * @param $name
     * @param $value
     * @return mixed
     */
    public function set($name, $value);

    /**
     * 根据名称获取系统配置
     * @param $name
     * @return mixed
     */
    public function get($name);
}
