<?php

namespace App\Common\Utils;

class ShippingCalcUtil
{
    /**
     * 计算运费
     * @param $weight
     * @param $priceBasisNumOne
     * @param $priceBasisNumTwo
     * @param $shippingDiscount
     * @return float|int
     */
    public static function calcFreight($weight, $priceBasisNumOne, $priceBasisNumTwo, $shippingDiscount)
    {
        return (((float)($weight / 1000) * (float)$priceBasisNumOne) + (float)$priceBasisNumTwo) * ((float)($shippingDiscount / 100));
    }

    /**
     * 计算固定毛利率
     * @param $commission
     * @param $profit
     * @param $freight
     * @param $exchangeRate
     * @param $price
     * @return float|int
     */
    public static function calcFixedGrossMargin($commission, $profit, $freight, $exchangeRate, $price)
    {
        $fixedGrossMargin = (1 - ((float)$commission / 100)- ((float)$profit + (float)$freight) / ((float)$price * (float)$exchangeRate));

        return round($fixedGrossMargin, 2) * 100;
    }

    /**
     * 计算售价
     * @param $profit
     * @param $freight
     * @param $exchangeRate
     * @param $commission
     * @param $fixedGrossMargin
     * @return float|int
     */
    public static function calcPrice($profit, $freight, $exchangeRate, $commission, $fixedGrossMargin)
    {
        return (((float)$profit + (float)$freight) / ((float)$exchangeRate)) / (1 - ((float)$commission / 100) - ((float)$fixedGrossMargin / 100));
    }

    /**
     * 计算平台售价
     * @param $price
     * @param $discountRate
     * @return float|int
     */
    public static function calcPlatformPrice($price, $discountRate)
    {
        return $price / (float)(1 - ((float)$discountRate / 100));
    }

    /**
     * 计算毛利利润
     * @param $price
     * @param $fixedGrossMargin
     * @return float|int
     */
    public static function calcGrossProfit($price, $fixedGrossMargin)
    {
        return $price * ((float)$fixedGrossMargin / 100);
    }
}
