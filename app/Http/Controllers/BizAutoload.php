<?php

namespace App\Http\Controllers;

use App\Component\BizAutoloader;

trait BizAutoload
{
    /**
     * 获取Biz\Service
     * @param $alias
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function createService($alias)
    {
        $autoloader = app()->make(BizAutoloader::class);

        return $autoloader->load('Service', $alias);
    }
}
