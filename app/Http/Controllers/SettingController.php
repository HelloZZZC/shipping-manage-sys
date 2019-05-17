<?php

namespace App\Http\Controllers;

use App\Biz\Setting\Service\SettingService;
use App\Common\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    use BizAutoload;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws InvalidArgumentException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function systemSetting(Request $request)
    {
        $setting = $this->getSettingService()->get('system_setting');

        if ('POST' == $request->getMethod()) {
            $rules = $this->getSystemSettingRules();
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                throw new InvalidArgumentException('非法提交');
            }
            $setting = $this->getSettingService()->set('system_setting', $validator->validated());
            $request->session()->flash('system_setting.saved', '保存成功!');
        }

        return view('setting.system_setting', [
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
        $currentSetting = $this->getSettingService()->get('shipping_setting');

        if ('POST' == $request->getMethod()) {
            $setting = $request->request->get('setting');
            $newSetting = [];
            foreach ($currentSetting as $single) {
                if (empty($setting)) {
                    $newSetting[] = $this->buildSettingWithEmpty($single);
                } else {
                    $newSetting[] = $this->buildSetting($single, $setting);
                }
            }
            $currentSetting = $this->getSettingService()->set('shipping_setting', $newSetting);
            $request->session()->flash('shipping_setting.saved', '保存成功!');
        }

        return view('setting.shipping_setting', [
            'setting' => empty($currentSetting) ? [] : $currentSetting,
        ]);
    }

    /**
     * @param $single
     * @return mixed
     */
    private function buildSettingWithEmpty($single)
    {
        $single['shipping'] = [];

        return $single;
    }

    /**
     * @param $single
     * @param $setting
     * @return mixed
     */
    private function buildSetting($single, $setting)
    {
        $countryId = $single['country_id'];
        $single['shipping'] = empty($setting[$countryId]) ? [] : $setting[$countryId];

        return $single;
    }

    /**
     * 系统配置表单提交rule
     * @return array
     */
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
