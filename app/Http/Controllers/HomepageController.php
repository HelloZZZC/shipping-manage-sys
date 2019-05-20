<?php

namespace App\Http\Controllers;

use App\Biz\User\Service\UserService;

class HomepageController extends Controller
{
    use BizAutoload;

    /**
     * 展示主页数据
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index()
    {
        $userCount = $this->getUserService()->countUsers(['without_deleted' => true]);

        return view('homepage', [
            'userCount' => $userCount,
        ]);
    }

    /**
     * @return UserService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserService()
    {
        return $this->createService('User:UserService');
    }
}
