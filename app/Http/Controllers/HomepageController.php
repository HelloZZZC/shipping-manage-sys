<?php

namespace App\Http\Controllers;

class HomepageController
{
    /**
     * 显示主页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('homepage');
    }
}
