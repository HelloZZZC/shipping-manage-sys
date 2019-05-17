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
}
