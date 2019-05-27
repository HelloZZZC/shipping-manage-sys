<?php

namespace App\Http\Controllers;

use App\Biz\Role\Service\RoleService;
use App\Common\Utils\RoleUtil;

class RoleController extends Controller
{
    use BizAutoload;

    /**
     * 渲染角色页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $roles = $this->getRoleService()->findAll();

        $permissions = [];
        foreach ($roles as $role) {
            foreach ($role->permissions->toArray() as $permission) {
                $permissions[$role->name][$permission['name']] = RoleUtil::transPermission($permission['name']);
            }
        }

        return view('role.role', [
            'roles' => $roles,
            'count' => count($roles->toArray()),
            'map' => RoleUtil::roleMap(),
            'permissions' => $permissions,
        ]);
    }

    /**
     * @return RoleService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getRoleService()
    {
        return $this->createService('Role:RoleService');
    }
}
