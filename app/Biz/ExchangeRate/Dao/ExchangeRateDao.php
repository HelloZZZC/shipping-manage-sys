<?php

namespace App\Biz\ExchangeRate\Dao;

interface ExchangeRateDao
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
}
