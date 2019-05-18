<?php

namespace App\Console\Commands;

use App\Biz\Setting\Service\SettingService;
use App\Biz\Shipping\Service\CountryService;
use App\Common\Exception\NotFoundException;
use App\Console\BaseCommands;

class SystemInitShipping extends BaseCommands
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:init-shipping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化国家物流配置';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $items = include dirname(__DIR__).'/../../config/systeminititems.php';
            $setting = [];
            foreach ($items['shipping_setting'] as $item) {
                $country = $this->getCountryService()->getCountryByNameCN($item['name_cn']);
                if (empty($country)) {
                    throw new NotFoundException("country #{$item['name_cn']} not found");
                }
                $setting[] = [
                    'country_id' => $country['id'],
                    'shipping' => $item['shipping'],
                    'country_cn' => $item['name_cn'],
                ];
            }

            $this->getSettingService()->set('shipping_setting', $setting);
            $this->info('初始化国家物流配置成功');
        } catch (\Throwable $t) {
            $this->error($t->getMessage());
        }
    }

    /**
     * @return SettingService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getSettingService()
    {
        return $this->createService('Setting:SettingService');
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
