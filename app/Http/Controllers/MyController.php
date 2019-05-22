<?php

namespace App\Http\Controllers;

use App\Biz\User\Service\UserProfileService;
use App\Biz\User\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
