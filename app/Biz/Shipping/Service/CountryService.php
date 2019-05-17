<?php

namespace App\Biz\Shipping\Service;

interface CountryService
{
    /**
     * 根据条件获取国家数量
     * @param $conditions
     * @return mixed
     */
    public function countCountries($conditions);

    /**
     * 根据条件获取国家数据
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function searchCountries($conditions, $orderBy, $offset, $limit);

    /**
     * 创建shipping国家
     * @param $country
     * @return mixed
     */
    public function createCountry($country);
}
