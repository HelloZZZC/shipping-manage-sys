<?php

namespace App\Biz\Role\Service\Impl;

use App\Biz\BaseService;
use App\Biz\Role\Service\RoleService;

class RoleServiceImpl extends BaseService implements RoleService
{
    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getRoleDao()
    {
        return $this->createDao('Role:RoleDao');
    }
}
