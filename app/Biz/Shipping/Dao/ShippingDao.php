<?php

namespace App\Biz\Shipping\Dao;

interface ShippingDao
{
    /**
     * 根据类型删除shipping数据
     * @param $type
     * @return mixed
     */
    public function deleteByType($type);

    public function batchCreate($rows);
}
