<?php

namespace App\Http\Controllers;

use App\Biz\File\Service\FileService;
use App\Biz\Shipping\Service\ShippingService;
use App\Common\Utils\ShippingInfoUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ImporterController extends Controller
{
    use BizAutoload;

    /**
     * 导入页面渲染
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($type)
    {
        $type = empty($type) ? ShippingService::TYPE_CHINA_POST : $type;

        return view('import.importer', [
            'type' => $type,
            'info' => ShippingInfoUtil::getInfo($type),
        ]);
    }

    /**
     * 导入modal框渲染
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($type)
    {
        $type = empty($type) ? ShippingService::TYPE_CHINA_POST : $type;

        return view('import.importer-modal', [
            'type' => $type,
            'info' => ShippingInfoUtil::getInfo($type),
        ]);
    }

    /**
     * 执行导入操作前先删掉shipping老数据
     * @param $type
     * @return ImporterController
     */
    public function preImport($type)
    {
        try {
            $this->getShippingService()->deleteShippingsByType($type);
        } catch (\Throwable $t) {
            Log::error($t->getMessage(), ['code' => $t->getCode(), 'trace' => $t->getTraceAsString()]);
            return $this->createJsonResponse([
                'progress' => 30,
            ], $t->getCode());
        }

        return $this->createJsonResponse([
            'progress' => 30,
        ]);
    }

    public function import(Request $request, $type)
    {
        try {
            $file = $request->file('file');

        } catch (\Throwable $t) {
            Log::error($t->getMessage(), ['code' => $t->getCode(), 'trace' => $t->getTraceAsString()]);
            return $this->createJsonResponse([
                'progress' => 90,
            ], $t->getCode());
        }

        return $this->createJsonResponse([
            'progress' => 100,
        ], 0);
    }

    /**
     * @return FileService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getFileService()
    {
        return $this->createService('File:FileService');
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
