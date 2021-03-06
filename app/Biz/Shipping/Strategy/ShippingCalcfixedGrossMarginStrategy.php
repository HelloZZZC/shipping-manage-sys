<?php

namespace App\Biz\Shipping\Strategy;

use App\Common\Utils\ShippingCalcUtil;

class ShippingCalcfixedGrossMarginStrategy extends BaseShippingCalcStrategy implements ShippingCalcStrategy
{
    /**
     * 计算详情数据
     * @param $params
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getPriceDetailInfo($params)
    {
        $setting = $this->getSettingService()->get('system_setting');

        $exchangeRateSetting = $setting['exchange_rate'];
        $commissionSetting = $setting['commission'];
        $shippingDiscount = $setting["{$params['shipping_discount']}_discount"];

        $freight = ShippingCalcUtil::calcFreight($params['weight'], $params['price_basis_num_one'], $params['price_basis_num_two'], $shippingDiscount);
        $price = ShippingCalcUtil::calcPrice($params['profit'], $freight, $exchangeRateSetting, $commissionSetting, $params['fixed_gross_margin']);
        $platformPrice = ShippingCalcUtil::calcPlatformPrice($price, $params['discount_rate']);
        $grossProfit = ShippingCalcUtil::calcGrossProfit($price, $params['fixed_gross_margin']);
        $grossProfitCNY = $grossProfit * $exchangeRateSetting;

        $shippingNameMap = $this->getShippingNameMap();

        return [
            'freight' => round($freight, 2),
            'price' => round($price, 2),
            'platform_price' => round($platformPrice, 2),
            'gross_profit' => round($grossProfit, 2),
            'gross_profit_CNY' => round($grossProfitCNY, 2),
            'shipping_name' => $shippingNameMap[$params['shipping_discount']],
            'fixed_gross_margin' => $params['fixed_gross_margin'],
        ];
    }
}
