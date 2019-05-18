<?php

namespace App\Biz\Shipping\Dao\Impl;

use App\Biz\Shipping\Dao\ShippingDao;
use App\Models\Shipping;

class ShippingDaoImpl implements ShippingDao
{
    /**
     * 根据type删除shipping
     * @param $type
     * @return mixed
     */
    public function deleteByType($type)
    {
        return Shipping::where('type', $type)->delete();
    }

    /**
     * 批量创建
     * @param $rows
     * @return mixed
     */
    public function batchCreate($rows)
    {
        return Shipping::insert($rows);
    }

    /**
     * @param $conditions
     * @return mixed
     */
    public function count($conditions)
    {
        $stmt = Shipping::select('*');

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

        $stmt = Shipping::select('*');

        return $this->buildQueryStatement($conditions, $stmt)->orderBy($orderBy[0], $orderBy[1])->offset($offset)->limit($limit)->get();
    }

    /**
     * @param $type
     * @param $countryId
     * @return mixed
     */
    public function getByTypeAndCountryId($type, $countryId)
    {
        return Shipping::where('type', $type)->where('country_id', $countryId)->first();
    }

    /**
     * @param $conditions
     * @param $stmt
     * @return mixed
     */
    protected function buildQueryStatement($conditions, $stmt)
    {
        if (isset($conditions['types'])) {
            $stmt = $stmt->whereIn('type', $conditions['types']);
        }

        if (isset($conditions['country_ids'])) {
            $stmt = $stmt->whereIn('country_id', $conditions['country_ids']);
        }

        return $stmt;
    }
}
