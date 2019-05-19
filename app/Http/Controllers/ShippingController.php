<?php

namespace App\Http\Controllers;

use App\Biz\Setting\Service\SettingService;
use App\Biz\Shipping\Service\ShippingService;
use App\Common\Exception\InvalidArgumentException;
use App\Common\Utils\ArrayUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    use BizAutoload;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request)
    {
        $conditions = $request->query->all();
        if (!$this->isQueryValid($conditions)) {
            return view('shipping', [
                'detail' => [],
            ]);
        }
        $setting = $this->getSettingService()->get('shipping_setting');
        $shippings = $this->getShippingService()->findShippingBySetting($setting);
        $group = ArrayUtil::group($shippings, 'country_id');

        $detail = $this->getShippingService()->buildDetail($conditions, $group, $setting);

        return view('shipping', [
            'detail' => $detail,
        ]);
    }

    /**
     * 后台判断表单提交是否合法
     * @param $conditions
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function isQueryValid($conditions)
    {
        $rules = $this->getRules();
        $validator = Validator::make($conditions, $rules);
        if ($validator->fails()) {
            return false;
        }
        if ($conditions['calc_mode'] == 'price' && !isset($conditions['price'])) {
            return false;
        }
        if ($conditions['calc_mode'] == 'fixed_gross_margin' && !isset($conditions['fixed_gross_margin'])) {
            return false;
        }
        $shippingSetting = $this->getSettingService()->get('shipping_setting');
        if (empty($shippingSetting)) {
            return false;
        }

        return true;
    }

    /**
     * 获取表单验证rule
     * @return array
     */
    private function getRules()
    {
        return [
            'price_basis_type' => 'required',
            'discount_rate' => 'required',
            'weight' => 'required',
            'profit' => 'required',
            'calc_mode' => 'required',
        ];
    }

    /**
     * @return ShippingService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getShippingService()
    {
        return $this->createService('Shipping:ShippingService');
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
