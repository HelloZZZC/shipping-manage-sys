<?php

namespace App\Biz\Shipping\Strategy;

use App\Common\Exception\InvalidArgumentException;

class ShippingCalcFactory
{
    /**
     * 根据type创建工厂instance
     * @param $type
     * @return ShippingCalcStrategy
     * @throws InvalidArgumentException
     */
    public static function createFactory($type)
    {
        $factories = self::getFactories();

        $types = array_keys($factories);
        if (!in_array($type, $types)) {
            throw new InvalidArgumentException('Invalid Type');
        }

        return new $factories[$type](app());
    }

    /**
     * 需要创建的工厂
     * @return array
     */
    public static function getFactories()
    {
        return [
            'price' => ShippingCalcPriceStrategy::class,
            'fixed_gross_margin' => ShippingCalcfixedGrossMarginStrategy::class,
        ];
    }
}
