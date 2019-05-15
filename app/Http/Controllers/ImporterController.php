<?php

namespace App\Http\Controllers;

use App\Biz\Shipping\Service\ShippingService;
use App\Common\Utils\ShippingInfoUtil;

class ImporterController extends Controller
{
    use BizAutoload;

    public function index($type)
    {
        $type = empty($type) ? ShippingService::TYPE_CHINA_POST : $type;

        return view('import.importer', [
            'type' => $type,
            'info' => ShippingInfoUtil::getInfo($type),
        ]);
    }

    public function show($type)
    {
        $type = empty($type) ? ShippingService::TYPE_CHINA_POST : $type;

        return view('import.importer-modal', [
            'type' => $type,
            'info' => ShippingInfoUtil::getInfo($type),
        ]);
    }

    /**
     * @return ShippingService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getShippingService()
    {
        return $this->createService('Shipping:ShippingService');
    }
}
