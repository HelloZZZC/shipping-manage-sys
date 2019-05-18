<?php

namespace App\Biz\Shipping\Strategy;


interface ShippingCalcStrategy
{
    public function getPriceDetailInfo($params);
}
