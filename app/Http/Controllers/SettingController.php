<?php

namespace App\Http\Controllers;

use App\Biz\Setting\Service\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use BizAutoload;

    /**
     * 系统设置页面渲染
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function systemSetting(Request $request)
    {
        $setting = $this->getSettingService()->get('system_setting');

        if ('POST' == $request->getMethod()) {
            $setting = $request->request->all();
        }

        return view('system_setting', [
            'setting' => empty($setting) ? [] : $setting,
        ]);
    }

    /**
     * 物流设置页面渲染
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function shippingSetting(Request $request)
    {
        $setting = $this->getSettingService()->get('shipping_setting');

        if ('POST' == $request->getMethod()) {
            $setting = $request->request->all();
        }

        return view('shipping_setting', [
            'setting' => empty($setting) ? [] : $setting,
        ]);
    }

    /**
     * @return SettingService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getSettingService()
    {
        return $this->createService('Setting:SettingService');
    }
}
