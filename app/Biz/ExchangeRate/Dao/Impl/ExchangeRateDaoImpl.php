<?php

namespace App\Biz\ExchangeRate\Dao\Impl;

use App\Biz\ExchangeRate\Dao\ExchangeRateDao;
use App\Models\ExchangeRate;

class ExchangeRateDaoImpl implements ExchangeRateDao
{
    /**
     * @param $conditions
     * @return mixed
     */
    public function count($conditions)
    {
        $stmt = ExchangeRate::select('*');

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

        $stmt = ExchangeRate::select('*');

        return $this->buildQueryStatement($conditions, $stmt)->orderBy($orderBy[0], $orderBy[1])->offset($offset)->limit($limit)->get();
    }

    /**
     * @param $conditions
     * @param $stmt
     * @return mixed
     */
    protected function buildQueryStatement($conditions, $stmt)
    {
        if (isset($conditions['created_at_GET'])) {
            $stmt = $stmt->where('created_at', '>=', $conditions['created_at_GET']);
        }
        if (isset($conditions['created_at_LET'])) {
            $stmt = $stmt->where('created_at', '<=', $conditions['created_at_LET']);
        }
        if (isset($conditions['from_countries'])) {
            $stmt = $stmt->whereIn('from_country', $conditions['from_countries']);
        }
        return $stmt;
    }
}
