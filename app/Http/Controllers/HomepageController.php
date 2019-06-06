<?php

namespace App\Http\Controllers;

use App\Biz\ExchangeRate\Service\ExchangeRateService;
use App\Biz\User\Service\UserService;
use App\Common\Utils\ArrayUtil;

class HomepageController extends Controller
{
    use BizAutoload;

    /**
     * 展示主页数据
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $userCount = $this->getUserService()->countUsers([]);

        $default = [
            'from_countries' => ['美元', '日元', '欧元', '英镑', '卢布'],
        ];

        // 今日汇率
        $conditions = [
            'created_at_GET' => date('Y-m-d').' 00:00:00',
            'created_at_LET' => date('Y-m-d').' 23:59:59',
        ];
        $conditions = array_merge($default, $conditions);
        $rateCount = $this->getExchangeRateService()->countExchangeRates($conditions);
        $rates = $this->getExchangeRateService()->searchExchangeRates($conditions, ['id', 'desc'], 0, $rateCount);
        $rates = ArrayUtil::index($rates->toArray(), 'from_country');
        $todayXAxis = [];
        $todayYAxis = [];
        foreach ($default['from_countries'] as $country) {
            $todayXAxis[] = $country.'/人民币';
            $todayYAxis[] = empty($rates[$country]) ? 0 : $rates[$country]['rate'];
        }

        // 汇率曲线
        $conditions = [
            'created_at_GET' => date('Y-m-d', strtotime('-6 day')).' 00:00:00',
            'created_at_LET' => date('Y-m-d').' 23:59:59',
            'from_countries' => ['美元', '卢布'],
        ];
        $rateCount = $this->getExchangeRateService()->countExchangeRates($conditions);
        $rates = $this->getExchangeRateService()->searchExchangeRates($conditions, ['id', 'asc'], 0, $rateCount);
        $group = ArrayUtil::group($rates->toArray(), 'from_country');
        $sevenDaysXAxis = [];
        for ($index = 0; $index < 7; $index++) {
            $sevenDaysXAxis[] = date('m-d', strtotime("{$conditions['created_at_GET']} +{$index}day"));
        }
        $USDSevenDayYAxis = $this->buildSevenDayYAxis($group['美元'], $sevenDaysXAxis);
        $SURSevenDayYAxis = $this->buildSevenDayYAxis($group['卢布'], $sevenDaysXAxis);

        return view('homepage', [
            'userCount' => $userCount,
            'todayXAxis' => json_encode($todayXAxis),
            'todayYAxis' => json_encode($todayYAxis),
            'sevenDayXAxis' => json_encode($sevenDaysXAxis),
            'USDSevenDayYAxis' => json_encode($USDSevenDayYAxis),
            'SURSevenDayYAxis' => json_encode($SURSevenDayYAxis),
        ]);
    }

    private function buildSevenDayYAxis($rates, $sevenDaysXAxis)
    {
        $newRates = [];
        foreach ($rates as $rate) {
            $newRates[date('m-d', strtotime($rate['created_at']))] = $rate;
        }

        $sevenDayYAxis = [];
        foreach ($sevenDaysXAxis as $dayXAxis) {
            $sevenDayYAxis[] = empty($newRates[$dayXAxis]) ? 0 : $newRates[$dayXAxis]['rate'];
        }

        return $sevenDayYAxis;
    }

    /**
     * @return UserService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserService()
    {
        return $this->createService('User:UserService');
    }

    /**
     * @return ExchangeRateService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getExchangeRateService()
    {
        return $this->createService('ExchangeRate:ExchangeRateService');
    }
}
