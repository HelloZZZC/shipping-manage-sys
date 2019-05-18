<?php

namespace App\Biz\Shipping\Dao;

interface ShippingDao
{
    /**
     * @param $type
     * @return mixed
     */
    public function deleteByType($type);

    /**
     * @param $rows
     * @return mixed
     */
    public function batchCreate($rows);

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
     * @param $type
     * @param $countryId
     * @return mixed
     */
    public function getByTypeAndCountryId($type, $countryId);
}
