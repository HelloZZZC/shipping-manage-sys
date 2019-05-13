<?php

namespace Biz\Setting\Dao\Impl;

use Biz\Setting\Dao\SettingDao;
use App\Models\Setting;

class SettingDaoImpl implements SettingDao
{
    /**
     * 根据名称获取系统配置
     * @param $name
     * @return mixed
     */
    public function getByName($name)
    {
        return Setting::where('name', $name)->first();
    }


    /**
     * 根据名称删除配置
     * @param $name
     * @return mixed
     */
    public function deleteByName($name)
    {
        return Setting::where('name', $name)->delete();
    }

    /**
     * 创建一条系统设置
     * @param $setting
     * @return mixed
     */
    public function create($setting)
    {
        return Setting::create($setting);
    }
}
