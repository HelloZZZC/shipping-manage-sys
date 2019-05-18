<?php

namespace App\Biz\Shipping\Strategy;

use App\Common\Utils\ShippingCalcUtil;

class ShippingCalcPriceStrategy extends BaseShippingCalcStrategy implements ShippingCalcStrategy
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

        $freight = ShippingCalcUtil::calcFreight($params['weight'], $params['priceBasisNumOne'], $params['priceBasisNumTwo'], $shippingDiscount['value']);
        $fixedGrossMargin = ShippingCalcUtil::calcFixedGrossMargin($commissionSetting['value'], $params['profit'], $freight, $exchangeRateSetting['value'], $params['price']);
        $platformPrice = ShippingCalcUtil::calcPlatformPrice($params['price'], $params['discount_rate']);
        $grossProfit = ShippingCalcUtil::calcGrossProfit($params['price'], $fixedGrossMargin);
        $grossProfitCNY = $grossProfit * $exchangeRateSetting['value'];

        $shippingNameMap = $this->getShippingNameMap();

        return [
            'freight' => round($freight, 2),
            'price' => $params['price'],
            'platformPrice' => round($platformPrice, 2),
            'grossProfit' => round($grossProfit, 2),
            'grossProfitCNY' => round($grossProfitCNY, 2),
            'shippingName' => $shippingNameMap[$params['shipping_discount']],
            'fixedGrossMargin' => $fixedGrossMargin,
        ];
    }
}
