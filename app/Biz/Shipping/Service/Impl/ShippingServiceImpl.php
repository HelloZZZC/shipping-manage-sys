<?php

namespace App\Biz\Shipping\Service\Impl;

use App\Biz\BaseService;
use App\Biz\Shipping\Dao\ShippingDao;
use App\Biz\Shipping\Service\ShippingService;
use App\Common\Exception\InvalidArgumentException;

class ShippingServiceImpl extends BaseService implements ShippingService
{
    protected $allowedTypes = [
        ShippingService::TYPE_CHINA_POST, ShippingService::TYPE_ALI_STANDARD, ShippingService::TYPE_E_MAIL,
    ];

    public function deleteShippingsByType($type)
    {
        if (!in_array($type, $this->allowedTypes)) {
            throw new InvalidArgumentException('Invalid type');
        }

        return $this->getShippingDao()->deleteByType($type);
    }

    /**
     * @return ShippingDao
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getShippingDao()
    {
        return $this->createDao('Shipping:ShippingDao');
    }
}
