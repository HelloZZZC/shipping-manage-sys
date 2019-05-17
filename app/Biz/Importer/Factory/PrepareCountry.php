<?php

namespace App\Biz\Importer\Factory;

use App\Common\Utils\ArrayUtil;
use App\Http\Controllers\BizAutoload;
use App\Biz\Shipping\Service\CountryService;

trait PrepareCountry
{
    use BizAutoload;

    /**
     * @param $data
     * @return array|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function prepareCountries($data)
    {
        $countryCount = $this->getCountryService()->countCountries([]);
        $countries = $this->getCountryService()->searchCountries([], ['id', 'asc'], 0, $countryCount);
        $countries = $countries->toArray();
        $countryNumbers = ArrayUtil::column($countries, 'number');

        foreach ($data as $single) {
            if (in_array($single['country_number'], $countryNumbers)) {
                continue;
            }

            $country = [
                'name_en' => $single['country_en'],
                'number' => $single['country_number'],
                'name_cn' => $single['country_cn'],
            ];

            $country = $this->getCountryService()->createCountry($country);
            $countryNumbers[] = $single['country_number'];
            $countries[] = $country;
        }

        return $countries;
    }

    /**
     * @return CountryService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getCountryService()
    {
        return $this->createService('Shipping:CountryService');
    }
}
