<?php

namespace App\Biz\Auth\Service\Impl;

use App\Biz\Auth\Service\AuthService;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Biz\BaseService;

class AuthServiceImpl extends BaseService implements AuthService
{
    /**
     * @param $user
     * @return mixed
     * @throws \Throwable
     */
    public function register($user)
    {
        try {
            DB::beginTransaction();
            $user = User::create($user);
            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            throw $t;
        }
        return $user;
    }
}
