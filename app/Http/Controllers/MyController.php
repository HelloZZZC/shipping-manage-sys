<?php

namespace App\Http\Controllers;

use App\Biz\User\Service\UserProfileService;
use App\Biz\User\Service\UserService;
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
            $this->getUserService()->changeUserPassword($user['id'], $fields);
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
        $checkedPWHash = Hash::make($checkedPW);

        if ($checkedPWHash != $currentUser->getAuthPassword()) {
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
