<?php

namespace App\Http\Controllers;

use App\Biz\User\Service\UserProfileService;
use App\Biz\User\Service\UserService;
use App\Common\Utils\ArrayUtil;
use App\Common\Utils\RoleUtil;
use Illuminate\Http\Request;

class RosterController extends Controller
{
    use BizAutoload;

    /**
     * 渲染花名册页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request)
    {
        $conditions = $request->query->all();

        $count = $this->getUserService()->countUsers($conditions);
        $users = $this->getUserService()->pagingUsers($conditions, ['id', 'desc'], 12);
        $userIds = ArrayUtil::column($users->toArray()['data'], 'id');
        $userProfiles = $this->getUserProfileService()->findUserProfilesByIds($userIds);
        $userProfiles = ArrayUtil::index($userProfiles->toArray(), 'id');

        return view('user.roster', [
            'count' => $count,
            'users' => $users,
            'profiles' => $userProfiles,
            'roles' => RoleUtil::roleMap(),
        ]);
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
     * @return UserService
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function getUserService()
    {
        return $this->createService('User:UserService');
    }
}
