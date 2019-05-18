<?php

namespace App\Biz\Shipping\Service\Impl;

use App\Biz\BaseService;
use App\Biz\Shipping\Dao\CountryDao;
use App\Biz\Shipping\Service\CountryService;

class CountryServiceImpl extends BaseService implements CountryService
{
    /**
     * @param $conditions
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function countCountries($conditions)
    {
        return $this->getCountryDao()->count($conditions);
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function searchCountries($conditions, $orderBy, $offset, $limit)
    {
        return $this->getCountryDao()->search($conditions, $orderBy, $offset, $limit);
    }

    /**
     * @param $country
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function createCountry($country)
    {
        return $this->getCountryDao()->create($country);
    }

    /**
     * @param $nameCN
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getCountryByNameCN($nameCN)
    {
        return $this->getCountryDao()->getByNameCN($nameCN);
    }

    /**
     * @return CountryDao
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getCountryDao()
    {
        return $this->createDao('Shipping:CountryDao');
    }
}
