<?php

namespace App\Biz\User\Service;

use Illuminate\Http\UploadedFile;

interface UserService
{
    /**
     * 获取单个用户
     * @param $id
     * @return mixed
     */
    public function getUser($id);

    /**
     * 获取用户数量
     * @param $conditions
     * @return mixed
     */
    public function countUsers($conditions);

    /**
     * 获取用户
     * @param $conditions
     * @param $orderBy
     * @param $offset
     * @param $limit
     * @return mixed
     */
    public function searchUsers($conditions, $orderBy, $offset, $limit);

    /**
     * 校验nickname是否合法
     * @param $nickname
     * @param null $exclude
     * @return mixed
     */
    public function isNicknameAvailable($nickname, $exclude = null);

    /**
     * 校验手机号是否合法
     * @param $mobile
     * @param null $exclude
     * @return mixed
     */
    public function isMobileAvailable($mobile, $exclude = null);

    /**
     * 校验邮箱是否合法
     * @param $email
     * @param null $exclude
     * @return mixed
     */
    public function isEmailAvailable($email, $exclude = null);

    /**
     * 校验用户字段注册是否符合
     * @param $registration
     * @return mixed
     */
    public function isUserRegistrationAvailable($registration);

    /**
     * 用户分页查询
     * @param $conditions
     * @param $orderBy
     * @param $limit
     * @return mixed
     */
    public function pagingUsers($conditions, $orderBy, $limit);

    /**
     * 创建用户
     * @param $user
     * @return mixed
     */
    public function createUser($user);

    /**
     * 更新用户主页数据
     * @param $id
     * @param $info
     * @return mixed
     */
    public function updateUserHomepage($id, $info);

    /**
     * 修改用户密码
     * @param $id
     * @param $fields
     * @return mixed
     */
    public function changeUserPassword($id, $fields);

    /**
     * @param $id
     * @param UploadedFile $avatar
     * @return mixed
     */
    public function changeAvatar($id, UploadedFile $avatar);

    /**
     * @param $nickname
     * @return mixed
     */
    public function getUserByNickname($nickname);

    /**
     * 封禁用户
     * @param $id
     * @return mixed
     */
    public function lockUser($id);

    /**
     * 解封用户
     * @param $id
     * @return mixed
     */
    public function unlockUser($id);

    /**
     * 修改用户角色
     * @param $id
     * @param $role
     * @return mixed
     */
    public function changeRole($id, $role);
}
