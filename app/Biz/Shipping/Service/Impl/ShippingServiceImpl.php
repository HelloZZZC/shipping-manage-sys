<?php

namespace App\Biz\Shipping\Service\Impl;

use App\Biz\BaseService;
use App\Biz\Shipping\Dao\ShippingDao;
use App\Biz\Shipping\Service\CountryService;
use App\Biz\Shipping\Service\ShippingService;
use App\Biz\Shipping\Strategy\ShippingCalcFactory;
use App\Common\Exception\InvalidArgumentException;
use App\Common\Exception\NotFoundException;
use App\Common\Utils\ArrayUtil;
use App\Common\Utils\ShippingCalcUtil;

class ShippingServiceImpl extends BaseService implements ShippingService
{
    protected $allowedTypes = [
        ShippingService::TYPE_CHINA_POST, ShippingService::TYPE_ALI_STANDARD, ShippingService::TYPE_E_MAIL,
    ];

    /**
     * @param $type
     * @return mixed
     * @throws InvalidArgumentException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deleteShippingsByType($type)
    {
        if (!in_array($type, $this->allowedTypes)) {
            throw new InvalidArgumentException('Invalid type');
        }

        return $this->getShippingDao()->deleteByType($type);
    }

    /**
     * @param $rows
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function batchCreateShippings($rows)
    {
        if (empty($rows)) {
            return true;
        }

        return $this->getShippingDao()->batchCreate($rows);
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function searchShippings($conditions, $orderBy, $offset, $limit)
    {
        $conditions = $this->prepareConditions($conditions);

        return $this->getShippingDao()->search($conditions, $orderBy, $offset, $limit);
    }

    /**
     * @param $conditions
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function countShippings($conditions)
    {
        $conditions = $this->prepareConditions($conditions);

        return $this->getShippingDao()->count($conditions);
    }

    /**
     * @param $setting
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function findShippingBySetting($setting)
    {
        $countryIds = ArrayUtil::column($setting, 'country_id');

        $conditions = [
            'types' => [
                ShippingService::TYPE_ALI_STANDARD, ShippingService::TYPE_CHINA_POST, ShippingService::TYPE_E_MAIL,
            ],
            'country_ids' => $countryIds,
        ];
        $count = $this->countShippings($conditions);
        $shippings = $this->searchShippings($conditions, ['id', 'desc'], 0, $count);

        return $shippings->toArray();
    }

    /**
     * @param $conditions
     * @param $group
     * @param $setting
     * @return array|mixed
     * @throws InvalidArgumentException
     * @throws NotFoundException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function buildDetail($conditions, $group, $setting)
    {
        $detail = [];
        foreach ($setting as $single) {
            if (empty($setting['shipping']) || empty($group[$setting['country_id']])) {
                continue;
            }

            $shippings = $group[$single['country_id']];
            $shippings = ArrayUtil::index($shippings, 'type');

            $detail[] = $single['country_cn'] == env('BASIC_COUNTRY_NAME_CN') ? $this->handleBasicCountryDetail($conditions, $single) : $this->handleOtherCountryDetail($conditions, $shippings, $single);
        }

        return $detail;
    }

    /**
     * @param $conditions
     * @param $setting
     * @return array
     * @throws InvalidArgumentException
     * @throws NotFoundException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function handleBasicCountryDetail($conditions, $setting)
    {
        $detailParams = $this->buildParamsForBasicCountry($conditions, $setting);
        $info = ShippingCalcFactory::createFactory($conditions['calc_mode'])->getPriceDetailInfo($detailParams);
        return array_merge(array('country_cn' => $setting['country_cn']), $info);
    }

    /**
     * @param $conditions
     * @param $shippings
     * @param $setting
     * @return array
     * @throws InvalidArgumentException
     */
    private function handleOtherCountryDetail($conditions, $shippings, $setting)
    {
        $keys = array_keys($setting['shipping']);
        $details = array();
        $settingMap = $this->getShippingSettingMap();

        foreach ($keys as $key) {
            if (empty($shippings[$settingMap[$key]])) {
                continue;
            }
            $shipping = $shippings[$settingMap[$key]];
            $detailParams = $this->buildParamsForOtherCountry($shipping, $conditions);
            $details[] = ShippingCalcFactory::createFactory($conditions['calc_mode'])->getPriceDetailInfo($detailParams);
        }

        $freights = ArrayUtil::column($details, 'freight');
        array_multisort($freights, SORT_ASC, $details);
        return array_merge(array('countryCN' => $setting['countryCN']), $details[0]);
    }

    /**
     * @return array
     */
    private function getShippingSettingMap()
    {
        return ['eMail', 'chinaPost', 'aliStandard'];
    }


    /**
     * @param $shipping
     * @param $fields
     * @return array
     * @throws InvalidArgumentException
     */
    private function buildParamsForOtherCountry($shipping, $fields)
    {
        $feeInfo = json_decode($shipping['cost'], true);
        if ($shipping['type'] == 'eMail') {
            $priceBasisNumOne = $feeInfo[0]['deliver_fee'];
            $priceBasisNumTwo = $feeInfo[0]['register_fee'];
            $shippingDiscount = 'e_mail';
        } else {
            $result = ShippingCalcUtil::getCostByWeight($fields['weight'], $feeInfo);
            $priceBasisNumOne = $result['deliver_fee'];
            $priceBasisNumTwo = $result['register_fee'];
            $shippingDiscount = $shipping['type'] == 'chinaPost' ? 'china_post' : 'ali_standard';
        }
        $params = [
            'weight' => $fields['weight'],
            'priceBasisNumOne' => $priceBasisNumOne,
            'priceBasisNumTwo' => $priceBasisNumTwo,
            'profit' => $fields['profit'],
            'discount_rate' => $fields['discount_rate'],
            'shipping_discount' => $shippingDiscount,
        ];

        if ($fields['calc_mode'] == 'fixed_gross_margin') {
            return array_merge(['fixed_gross_margin' => $fields['fixed_gross_margin']], $params);
        }

        return array_merge(['price' => $fields['price']], $params);
    }

    /**
     * 构建需要对比国家的计算参数
     * @param $fields
     * @param $setting
     * @return array
     * @throws InvalidArgumentException
     * @throws NotFoundException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function buildParamsForBasicCountry($fields, $setting)
    {
        list($priceBasisNumOne, $priceBasisNumTwo) = $this->getCountryPriceBasic($setting['country_id'], $fields['price_basis_type']);
        $params = [
            'weight' => $fields['weight'],
            'price_basis_num_one' => $priceBasisNumOne,
            'price_basis_num_two' => $priceBasisNumTwo,
            'profit' => $fields['profit'],
            'discount_rate' => $fields['discount_rate'],
            'shipping_discount' => $fields['price_basis_type'] == 'eMail' ? 'e_mail' : 'ali_standard',
        ];

        if ($fields['calc_mode'] == 'fixed_gross_margin') {
            return array_merge(['fixed_gross_margin' => $fields['fixed_gross_margin']], $params);
        }

        return array_merge(['price' => $fields['price']], $params);
    }

    /**
     * @param $countryId
     * @param $type
     * @return array
     * @throws InvalidArgumentException
     * @throws NotFoundException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function getCountryPriceBasic($countryId, $type)
    {
        $shipping = $this->getShippingDao()->getByTypeAndCountryId($type, $countryId);
        if (empty($shipping)) {
            throw new NotFoundException("Resource Not Found");
        }

        $costs = json_decode($shipping['cost'], true);
        if (ShippingService::TYPE_E_MAIL == $type) {
            return [$costs[0]['deliver_fee'], $costs[0]['register_fee']];
        }

        $priceBasicWeightRange = env('BASIC_WEIGHT_RANGE');
        $cost = ShippingCalcUtil::getCostByWeight($priceBasicWeightRange, $costs);

        return [$cost['deliver_fee'], $cost['register_fee']];
    }

    /**
     * @param $conditions
     * @return array
     */
    protected function prepareConditions($conditions)
    {
        $conditions = array_filter($conditions, function($value) {
            if (0 == $value) {
                return true;
            }

            return !empty($value);
        });

        return $conditions;
    }

    /**
     * @return CountryService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getCountryService()
    {
        return $this->createService('Shipping:CountryService');
    }

    /**
     * @return ShippingDao
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getShippingDao()
    {
        return $this->createDao('Shipping:ShippingDao');
    }
}
