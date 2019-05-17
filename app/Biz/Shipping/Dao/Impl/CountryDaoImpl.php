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
        return ShippingCountry::where($conditions)->count();
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

        return ShippingCountry::where($conditions)->orderBy($orderBy[0], $orderBy[1])->offset($offset)->limit($limit)->get();
    }

    /**
     * @param $country
     * @return mixed
     */
    public function create($country)
    {
        return ShippingCountry::create($country);
    }
}
