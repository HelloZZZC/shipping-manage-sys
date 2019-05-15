<?php

namespace App\Common\Utils;


class ShippingInfoUtil
{
    public static function getInfo($type)
    {
        $info = [
            'chinaPost' => [
                'name' => '中国邮政挂号小包',
                'filename' => 'china_post_example.xlsx',
            ],
            'aliStandard' => [
                'name' => 'AliExpress无忧物流（标准）',
                'filename' => 'ali_standard_example.xlsx',
            ],
            'eMail' => [
                'name' => 'e邮宝',
                'filename' => 'email_example.xlsx',
            ],
        ];

        return $info[$type];
    }
}
