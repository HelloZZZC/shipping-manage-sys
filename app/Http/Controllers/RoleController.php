<?php

namespace App\Http\Controllers;


class RoleController extends Controller
{
    use BizAutoload;

    public function index()
    {

    }

    protected function getRoleService()
    {
        return $this->createService('Role:RoleService');
    }
}
