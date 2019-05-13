<?php

namespace App\Biz;

use Illuminate\Contracts\Foundation\Application;
use App\Component\BizAutoloader;

class BaseService
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
        $autoloader = app()->make(BizAutoloader::class);

        return $autoloader->load('Service', $alias);
    }

    /**
     * 获取Biz\Dao
     * @param $alias
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function createDao($alias)
    {
        $autoloader = app()->make(BizAutoloader::class);

        return $autoloader->load('Dao', $alias);
    }
}
