<?php

namespace App\Console;

use Illuminate\Console\Command;
use App\Component\BizAutoloader;

class BaseCommands extends Command
{
    /**
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
