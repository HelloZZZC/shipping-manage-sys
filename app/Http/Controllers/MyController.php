<?php

namespace App\Http\Controllers;

use App\Biz\User\Service\UserProfileService;
use App\Biz\User\Service\UserService;
use App\Common\Exception\InvalidArgumentException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyController extends Controller
{
    use BizAutoload;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function homepage(Request $request)
    {
        $user = Auth::user();
        $profile = $this->getUserProfileService()->getUserProfile($user->id);

        if ('POST' == $request->getMethod()) {
            $info = $request->request->all();
            $info['verified_mobile'] = empty($info['mobile']) ? '' : $info['mobile'];
            unset($info['mobile']);

            $this->getUserService()->updateUserHomepage($user['id'], $info);

            return $this->createJsonResponse([], 0, '个人数据保存成功');
        }

        return view('my.homepage', [
            'user' => $user,
            'profile' => $profile
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $profile = $this->getUserProfileService()->getUserProfile($user->id);

        if ('POST' == $request->getMethod()) {
            $fields = $request->request->all();
            if (empty($fields['old_password'])) {
                throw new InvalidArgumentException('缺少旧密码字段');
            }
            if (!Hash::check($fields['old_password'], $user->getAuthPassword())) {
                throw new InvalidArgumentException('提交的旧密码于当前用户密码不匹配');
            }
            $this->getUserService()->changeUserPassword($user['id'], $fields);

            return $this->createJsonResponse([], 0, '修改密码成功');
        }

        return view('my.password-change', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * 当前用户密码校验
     * @param Request $request
     * @return JsonResponse
     */
    public function checkCurrentPassword(Request $request)
    {
        $currentUser = Auth::user();
        $checkedPW = $request->query->get('old_password');

        if (!Hash::check($checkedPW, $currentUser->getAuthPassword())) {
            return JsonResponse::create(false);
        }

        return JsonResponse::create(true);
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
     * @return UserProfileService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserProfileService()
    {
        return $this->createService('User:UserProfileService');
    }
}
