<?php

namespace App\Biz\User\Service\Impl;

use App\Biz\User\Service\UserProfileService;
use App\Biz\User\Service\UserService;
use App\Biz\BaseService;
use App\Biz\User\Dao\UserDao;
use App\Common\Exception\InvalidArgumentException;
use App\Common\Utils\ArrayUtil;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Common\Exception\NotFoundException;
use Illuminate\Http\UploadedFile;

class UserServiceImpl extends BaseService implements UserService
{
    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUser($id)
    {
        return $this->getUserDao()->get($id);
    }

    /**
     * @param $conditions
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function countUsers($conditions)
    {
        $conditions = $this->prepareConditions($conditions);

        return $this->getUserDao()->count($conditions);
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function searchUsers($conditions, $orderBy, $offset, $limit)
    {
        $conditions = $this->prepareConditions($conditions);

        return $this->getUserDao()->search($conditions, $orderBy, $offset, $limit);
    }

    /**
     * @param $email
     * @param null $exclude
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function isEmailAvailable($email, $exclude = null)
    {
        if (empty($email)) {
            return false;
        }

        if ($email == $exclude) {
            return true;
        }

        $user = $this->getUserDao()->getByEmail($email);

        return empty($user);
    }

    /**
     * @param $mobile
     * @param null $exclude
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function isMobileAvailable($mobile, $exclude = null)
    {
        if (empty($mobile)) {
            return false;
        }

        if ($mobile == $exclude) {
            return true;
        }

        $user = $this->getUserDao()->getByMobile($mobile);

        return empty($user);
    }

    /**
     * @param $nickname
     * @param null $exclude
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function isNicknameAvailable($nickname, $exclude = null)
    {
        if (empty($nickname)) {
            return false;
        }

        if ($nickname == $exclude) {
            return true;
        }

        $user = $this->getUserDao()->getByNickname($nickname);

        return empty($user);
    }

    /**
     * @param $registration
     * @return bool|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function isUserRegistrationAvailable($registration)
    {
        if (!ArrayUtil::requireds($registration, ['nickname', 'email', 'password', 'verified_mobile'])) {
            return false;
        }

        $conditions = [
            'nickname' => $registration['nickname'],
            'or_email' => $registration['email'],
            'or_verified_mobile' => $registration['verified_mobile'],
        ];
        $count = $this->getUserDao()->count($conditions);

        return !$count;
    }

    /**
     * @param $conditions
     * @param $orderBy
     * @param $limit
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function pagingUsers($conditions, $orderBy, $limit)
    {
        $conditions = $this->prepareConditions($conditions);

        return $this->getUserDao()->paging($conditions, $orderBy, $limit);
    }

    /**
     * @param $user
     * @return mixed
     * @throws InvalidArgumentException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function createUser($user)
    {
        $rules = $this->getCreateUserRules();
        $validator = Validator::make($user, $rules);
        if ($validator->fails()) {
            throw new InvalidArgumentException("创建用户字段验证失败");
        }
        $user = $validator->validated();

        return $this->getUserDao()->create($user);
    }

    /**
     * @param $id
     * @param $info
     * @return mixed|void
     * @throws \Throwable
     */
    public function updateUserHomepage($id, $info)
    {
        $currentUser = Auth::user();

        $rules = $this->getCreateUserRules();
        unset($rules['password']);
        unset($rules['nickname']);

        try {
            DB::beginTransaction();

            $validator = Validator::make($info, $rules);
            if ($validator->fails()) {
                throw new InvalidArgumentException("表单数据验证不通过");
            }
            $user = $validator->validated();
            if ($currentUser->email != $user['email'] ||
                $currentUser->verified_mobile != $user['verified_mobile']
            ) {
                $this->getUserDao()->update($id, $user);
            }

            unset($info['email']);
            unset($info['verified_mobile']);
            unset($info['_token']);

            $this->getUserProfileService()->updateUserProfile($id, $info);

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();
            throw $t;
        }
    }

    /**
     * @param $id
     * @param $fields
     * @return mixed|void
     * @throws InvalidArgumentException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function changeUserPassword($id, $fields)
    {
        $rules = $this->getChangePasswordRules();
        $validator = Validator::make($fields, $rules);
        if ($validator->fails()) {
            throw new InvalidArgumentException("表单数据验证不通过");
        }

        $fields = $validator->validated();
        $fields['password'] = Hash::make($fields['new_password']);
        unset($fields['confirm_password']);
        unset($fields['new_password']);

        $this->getUserDao()->update($id, $fields);

        $user = $this->getUserDao()->get($id);
        event(new ResetPassword($user));
        Auth::guard()->login($user);
    }

    /**
     * @param $id
     * @param UploadedFile $avatar
     * @return mixed
     * @throws InvalidArgumentException
     * @throws NotFoundException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function changeAvatar($id, UploadedFile $avatar)
    {
        if (empty($avatar) || !is_object($avatar)) {
            throw new InvalidArgumentException('头像参数异常');
        }

        $ext = $avatar->extension();
        $timestamp = time();
        $filePath = Storage::putFileAs('public/images/avatar', $avatar, "user_{$id}_{$timestamp}.{$ext}");
        $absolutePath = storage_path().'/app/'.$filePath;
        if (!is_file($absolutePath)) {
            throw new NotFoundException("头像文件资源找不到");
        }
        $avatarLink = str_replace('public/', '', $filePath);

        return $this->getUserDao()->update($id, ['avatar' => $avatarLink]);
    }

    /**
     * @param $nickname
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getUserByNickname($nickname)
    {
        return $this->getUserDao()->getByNickname($nickname);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function lockUser($id)
    {
        return $this->getUserDao()->lock($id);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function unlockUser($id)
    {
        return $this->getUserDao()->unlock($id);
    }

    /**
     * 修改密码的规则
     * @return array
     */
    protected function getChangePasswordRules()
    {
        return [
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ];
    }

    /**
     * 创建用户的规则
     * @return array
     */
    protected function getCreateUserRules()
    {
        return [
            'nickname' => 'required|alpha_num',
            'password' => 'required',
            'email' => 'required|email',
            'verified_mobile' => 'required',
        ];
    }

    /**
     * @param $conditions
     * @return array
     */
    protected function prepareConditions($conditions)
    {
        $conditions = array_filter($conditions, function($value) {
            if (0 == $value) {
                return true;
            }

            return !empty($value);
        });

        if (isset($conditions['keyword_type']) && isset($conditions['keyword'])) {
            $conditions["like_{$conditions['keyword_type']}"] = $conditions['keyword'];
            unset($conditions['keyword']);
            unset($conditions['keyword_type']);
        }

        if (isset($conditions['deleted_status']) && $conditions['deleted_status'] == 'only_deleted') {
            $conditions[$conditions['deleted_status']] = true;
            unset($conditions['deleted_status']);
        }

        if (isset($conditions['deleted_status']) && $conditions['deleted_status'] == 'without_deleted') {
            unset($conditions['with_deleted']);
            unset($conditions['deleted_status']);
        }

        return $conditions;
    }

    /**
     * @return UserProfileService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserProfileService()
    {
        return $this->createService('User:UserProfileService');
    }

    /**
     * @return UserDao
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserDao()
    {
        return $this->createDao('User:UserDao');
    }
}
