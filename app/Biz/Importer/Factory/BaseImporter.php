<?php

namespace App\Biz\Importer\Factory;

use Illuminate\Contracts\Foundation\Application;
use App\Component\BizAutoloader;

class BaseImporter
{
    /**
     * @var Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * 获取Biz\Service
     * @param $alias
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function createService($alias)
    {
        $autoloader = $this->app->make(BizAutoloader::class);

        return $autoloader->load('Service', $alias);
    }
}
