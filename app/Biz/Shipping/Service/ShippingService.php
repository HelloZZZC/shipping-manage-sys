<?php

namespace App\Biz\Shipping\Service;

interface ShippingService
{
    const TYPE_CHINA_POST = 'chinaPost';

    const TYPE_E_MAIL = 'eMail';

    const TYPE_ALI_STANDARD = 'aliStandard';

    /**
     * 根据type删除shipping数据
     * @param $type
     * @return mixed
     */
    public function deleteShippingsByType($type);

    /**
     * 批量创建shipping数据
     * @param $rows
     * @return mixed
     */
    public function batchCreateShippings($rows);

    /**
     * 查询shipping数量
     * @param $conditions
     * @return mixed
     */
    public function countShippings($conditions);

    /**
     * 查询shipping
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function searchShippings($conditions, $orderBy, $offset, $limit);

    /**
     * 根据setting获取shipping数据
     * @param $setting
     * @return mixed
     */
    public function findShippingBySetting($setting);

    /**
     * 物流计算页面数据计算
     * @param $conditions
     * @param $group
     * @param $setting
     * @return mixed
     */
    public function buildDetail($conditions, $group, $setting);
}
