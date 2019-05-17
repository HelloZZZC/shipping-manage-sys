<?php

namespace App\Biz\Shipping\Dao;

interface CountryDao
{
    /**
     * @param $conditions
     * @return mixed
     */
    public function count($conditions);

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function search($conditions, $orderBy, $offset, $limit);

    /**
     * @param $country
     * @return mixed
     */
    public function create($country);
}
