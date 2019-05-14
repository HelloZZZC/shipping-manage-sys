<?php

namespace App\Http\Controllers;

use App\Biz\Shipping\Service\ShippingService;
use Illuminate\Http\Request;

class ImporterController extends Controller
{
    use BizAutoload;

    public function index(Request $request, $type)
    {
        return view('importer.blade.php', [
            'type' => empty($type) ? ShippingService::TYPE_CHINA_POST : $type,
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
