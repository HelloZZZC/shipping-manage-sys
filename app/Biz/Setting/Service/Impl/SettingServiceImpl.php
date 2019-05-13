<?php

namespace App\Biz\Setting\Service\Impl;

use Biz\Setting\Service\SettingService;
use App\Biz\BaseService;

class SettingServiceImpl extends BaseService implements SettingService
{
    /**
     * @param $name
     * @return array|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function get($name)
    {
        $setting = $this->getSettingDao()->getByName($name);
        if (empty($setting)) {
            return [];
        }

        return unserialize($setting['value']);
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function set($name, $value)
    {
        $this->getSettingDao()->deleteByName($name);
        $fields = [
            'name' => $name,
            'value' => serialize($value),
        ];

        $result = $this->getSettingDao()->create($fields);

        return unserialize($result['value']);
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getSettingDao()
    {
        return $this->createDao('Setting:SettingDao');
    }
}
