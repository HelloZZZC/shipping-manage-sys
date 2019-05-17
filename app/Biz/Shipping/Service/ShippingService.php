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
}
