<?php

namespace App\Component;

use App\Common\Exception\InvalidArgumentException;
use Illuminate\Contracts\Foundation\Application;

class BizAutoloader
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
     * 自动加载Biz对应的业务模块
     * @param $makerName
     * @param $alias
     * @return mixed
     * @throws \Exception
     */
    public function load($makerName, $alias)
    {
        $parts = explode(':', $alias);
        if (empty($parts) or count($parts) != 2) {
            throw new InvalidArgumentException('Alias is invalid');
        }

        if (isset($this->app["@{$alias}"])) {
            return $this->app["@{$alias}"];
        }

        $prefix = $parts[0];
        $name = $parts[1];
        $class = "App\\Biz\\{$prefix}\\{$makerName}\\Impl\\{$name}Impl";

        $obj = new $class($this->app);
        $this->app["@{$alias}"] = $obj;

        return $obj;
    }
}
