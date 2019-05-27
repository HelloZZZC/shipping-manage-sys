<?php

namespace App\Biz\Role\Dao\Impl;

use App\Biz\Role\Dao\RoleDao;
use Spatie\Permission\Models\Role;

class RoleDaoImpl implements RoleDao
{
    public function all()
    {
        return Role::get();
    }
}
