<?php

namespace App\Console\Commands;

use App\Console\BaseCommands;
use Illuminate\Support\Facades\Hash;
use App\Biz\Auth\Service\AuthService;

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
            $this->initSuperAdmin();
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
     * @return AuthService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function getAuthService()
    {
        return $this->createService('Auth:AuthService');
    }
}
