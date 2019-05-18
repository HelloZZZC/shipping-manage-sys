<?php

namespace App\Biz\Shipping\Strategy;

use App\Biz\Setting\Service\SettingService;
use App\Biz\Shipping\Service\ShippingService;
use Illuminate\Contracts\Foundation\Application;
use App\Component\BizAutoloader;

class BaseShippingCalcStrategy
{
    /**
     * @var Application|mixed
     */
    protected $app;

    public function __construct()
    {
        $this->app = app();
    }

    /**
     * @return array
     */
    protected function getShippingNameMap()
    {
        return array(
            'e_mail' => 'e邮宝',
            'china_post' => '中国邮政挂号小包',
            'ali_standard' => 'AliExpress无忧物流—标准',
        );
    }

    /**
     * 获取Biz\Service
     * @param $alias
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function createService($alias)
    {
        $autoloader = $this->app->make(BizAutoloader::class);

        return $autoloader->load('Service', $alias);
    }

    /**
     * 获取Biz\Dao
     * @param $alias
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function createDao($alias)
    {
        $autoloader = $this->app->make(BizAutoloader::class);

        return $autoloader->load('Dao', $alias);
    }

    /**
     * @return SettingService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getSettingService()
    {
        return $this->createService('Setting:SettingService');
    }

    /**
     * @return ShippingService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getShippingCostService()
    {
        return $this->createService('Shipping:ShippingService');
    }
}
