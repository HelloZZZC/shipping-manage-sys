<?php

namespace App\Console\Commands;

use App\Biz\User\Service\UserService;
use App\Console\BaseCommands;
use Illuminate\Support\Facades\Hash;
use App\Biz\Auth\Service\AuthService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SystemInit extends BaseCommands
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:init {nickname} {email} {verified_mobile} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化系统';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        try {
            $this->initRoles();
            $this->initSuperAdmin();
            $this->initUserSuperAdmin();
        } catch (\Throwable $t) {
            $this->error($t->getMessage());
        }
    }

    /**
     * 初始化系统超级管理员
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function initSuperAdmin()
    {
        $admin = $this->arguments();
        $tempPW = $admin['password'];
        $admin['password'] = Hash::make($admin['password']);

        $this->getAuthService()->register($admin);

        $this->info('初始化超级管理员成功');
        $this->table(['nickname', 'email', 'verified_mobile', 'password'], [
            [$admin['nickname'], $admin['email'], $admin['verified_mobile'], $tempPW]
        ]);
    }

    /**
     * 初始化用户角色以及权限
     */
    private function initRoles()
    {
        $roles = [
            'user' => Role::create(['name' => 'user']),
            'admin' => Role::create(['name' => 'admin']),
            'superAdmin' => Role::create(['name' => 'superAdmin']),
        ];
        $permissions = [
            'viewHomepage' => Permission::create(['name' => 'viewHomepage']),
            'viewUser' => Permission::create(['name' => 'viewUser']),
            'viewRole' => Permission::create(['name' => 'viewRole']),
            'viewRoster' => Permission::create(['name' => 'viewRoster']),
            'viewImporter' => Permission::create(['name' => 'viewImporter']),
            'viewShipping' => Permission::create(['name' => 'viewShipping']),
            'viewSetting' => Permission::create(['name' => 'viewSetting'])
        ];
        $userPermissons = $this->getUserPermissions();

        foreach ($roles as $type => $role) {
            foreach ($userPermissons[$type] as $userPermission) {
                $role->givePermissionTo($permissions[$userPermission]);
            }
        }

        $this->info('初始化角色以及用户权限成功');
    }

    /**
     * 初始化超级管理员角色
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function initUserSuperAdmin()
    {
        $admin = $this->arguments();
        $user = $this->getUserService()->getUserByNickname($admin['nickname']);
        $user->syncRoles(['superAdmin']);
    }

    /**
     * 定义用户角色
     * @return array
     */
    private function getUserPermissions()
    {
        return [
            'user' => [
                'viewHomepage', 'viewRoster', 'viewShipping',
            ],
            'admin' => [
                'viewHomepage', 'viewRoster', 'viewShipping', 'viewUser', 'viewRole', 'viewSetting', 'viewImporter',
            ],
            'superAdmin' => [
                'viewHomepage', 'viewRoster', 'viewShipping', 'viewUser', 'viewRole', 'viewSetting', 'viewImporter',
            ],
        ];
    }

    /**
     * @return UserService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function getUserService()
    {
        return $this->createService('User:UserService');
    }

    /**
     * @return AuthService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function getAuthService()
    {
        return $this->createService('Auth:AuthService');
    }
}
