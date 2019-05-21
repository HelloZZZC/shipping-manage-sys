<?php

namespace App\Biz\Importer\Factory;

use App\Biz\Auth\Service\AuthService;
use App\Biz\User\Service\UserService;
use App\Common\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserImporter extends BaseImporter
{
    protected $startRow = 2;

    protected $startCol = 1;

    protected $importMsg = '';

    public function getRequiredFields()
    {
        return [
            'nickname',
            'email',
            'verified_mobile',
            'password',
        ];
    }

    public function execute($data)
    {
        try {
            DB::beginTransaction();
            $parts = array_chunk($data, 50);
            $rules = $this->getRegistrationRules();
            foreach ($parts as $page => $part) {
                foreach ($part as $index => $single) {
                    $dataIndex = $page * 50 + $index + $this->startRow;
                    $validator = Validator::make($single, $rules);
                    if ($validator->fails()) {
                        throw new InvalidArgumentException("导入第{$dataIndex}行用户数据缺失必要字段");
                    }
                    $registration = $validator->validated();
                    $isUserAvailable = $this->getUserService()->isUserRegistrationAvailable($registration);
                    if (!$isUserAvailable) {
                        $this->importMsg .= '第'.$dataIndex.'行用户因账号、邮箱、手机号已存在被跳过注册，请检查！</br>';
                        continue;
                    }
                    $registration['password'] = Hash::make($registration['password']);
                    $this->getAuthService()->register($registration);
                }
            }

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            throw $t;
        }
    }

    public function getImportMessage()
    {
        return $this->importMsg;
    }

    protected function getRegistrationRules()
    {
        return [
            'nickname' => 'required|alpha_num',
            'password' => 'required',
            'email' => 'required|email',
            'verified_mobile' => 'required',
        ];
    }

    /**
     * @return UserService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserService()
    {
        return $this->createService('User:UserService');
    }

    /**
     * @return AuthService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getAuthService()
    {
        return $this->createService('Auth:AuthService');
    }
}
