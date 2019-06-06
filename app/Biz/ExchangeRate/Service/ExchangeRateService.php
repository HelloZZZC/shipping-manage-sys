<?php

namespace App\Biz\ExchangeRate\Service;

interface ExchangeRateService
{
    /**
     * 获取汇率数据
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function searchExchangeRates($conditions, $orderBy, $offset, $limit);

    /**
     * 获取汇率数据数量
     * @param $conditions
     * @return mixed
     */
    public function countExchangeRates($conditions);
}
