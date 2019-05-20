<?php

namespace App\Biz\Shipping\Dao\Impl;

use App\Biz\Shipping\Dao\CountryDao;
use App\Models\ShippingCountry;

class CountryDaoImpl implements CountryDao
{
    /**
     * @param $conditions
     * @return mixed
     */
    public function count($conditions)
    {
        $stmt = ShippingCountry::select('*');

        return $this->buildQueryStatement($conditions, $stmt)->count();
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function search($conditions, $orderBy, $offset, $limit)
    {
        $offset = (int) $offset;
        $limit = (int) $limit;

        $stmt = ShippingCountry::select('*');

        return $this->buildQueryStatement($conditions, $stmt)->orderBy($orderBy[0], $orderBy[1])->offset($offset)->limit($limit)->get();
    }

    /**
     * @param $country
     * @return mixed
     */
    public function create($country)
    {
        return ShippingCountry::create($country);
    }

    public function getByNameCN($nameCN)
    {
        return ShippingCountry::where('name_cn', $nameCN)->first();
    }

    /**
     * @param $conditions
     * @param $stmt
     * @return mixed
     */
    protected function buildQueryStatement($conditions, $stmt)
    {
        return $stmt;
    }
}
