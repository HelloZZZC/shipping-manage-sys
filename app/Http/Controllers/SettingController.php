<?php

namespace App\Http\Controllers;

use App\Biz\Setting\Service\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $rules = $this->getSystemSettingRules();
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                //do something
            }
            $setting = $this->getSettingService()->set('system_setting', $validator->validated());
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
            $setting = $this->getSettingService()->set('shipping_setting', $setting);
        }

        return view('shipping_setting', [
            'setting' => empty($setting) ? [] : $setting,
        ]);
    }

    protected function getSystemSettingRules()
    {
        return [
            'exchange_rate' => 'required',
            'commission' => 'required',
            'e_mail_discount' => 'required',
            'china_post_discount' => 'required',
            'ali_standard_discount' => 'required',
        ];
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
