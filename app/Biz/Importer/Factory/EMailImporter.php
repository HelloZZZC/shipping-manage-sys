<?php

namespace App\Biz\Importer\Factory;

use App\Biz\Shipping\Service\ShippingService;
use App\Common\Utils\ArrayUtil;
use Illuminate\Support\Facades\DB;

class EMailImporter extends BaseImporter
{
    use PrepareCountry;

    protected $type = ShippingService::TYPE_E_MAIL;

    protected $startRow = 2;

    protected $startCol = 1;

    public function getRequiredFields()
    {
        return [
            'country_en',
            'country_number',
            'country_cn',
            'first_range_deliver_fee',
            'first_range_register_fee',
        ];
    }

    /**
     * @param $data
     * @return mixed|void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function execute($data)
    {
        $countries = $this->prepareCountries($data);
        $countries = ArrayUtil::index($countries, 'number');

        try {
            DB::beginTransaction();

            $firstWeightRange = array('unlimited', 'unlimited');
            $parts = array_chunk($data, 50);
            foreach ($parts as $part) {
                $rows = [];
                foreach ($part as $single) {
                    $country = $countries[$single['country_number']];
                    $shipping = [
                        'type' => $this->type,
                        'country_id' => $country['id'],
                        'cost' => json_encode([
                            [
                                'min' => $firstWeightRange[0],
                                'max' => $firstWeightRange[1],
                                'deliver_fee' => $single['first_range_deliver_fee'],
                                'register_fee' => $single['first_range_register_fee'],
                            ],
                        ]),
                    ];
                    $rows[] = $shipping;
                }
                $this->getShippingService()->batchCreateShippings($rows);
            }

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            throw $t;
        }
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
