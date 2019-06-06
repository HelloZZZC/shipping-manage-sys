<?php

namespace App\Biz\ExchangeRate\Service\Impl;

use App\Biz\BaseService;
use App\Biz\ExchangeRate\Service\ExchangeRateService;
use App\Biz\ExchangeRate\Dao\ExchangeRateDao;

class ExchangeRateServiceImpl extends BaseService implements ExchangeRateService
{
    /**
     * @param $conditions
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function countExchangeRates($conditions)
    {
        return $this->getExchangeRateDao()->count($conditions);
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function searchExchangeRates($conditions, $orderBy, $offset, $limit)
    {
        return $this->getExchangeRateDao()->search($conditions, $orderBy, $offset, $limit);
    }

    /**
     * @return ExchangeRateDao
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getExchangeRateDao()
    {
        return $this->createDao('ExchangeRate:ExchangeRateDao');
    }
}
