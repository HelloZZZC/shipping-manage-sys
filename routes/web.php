<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/**
 * shippingMS所有用户均通过管理员角色的用户导入至系统，不开放注册
 */
Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

/**
 * 业务相关的路由都需要认证用户才能够访问
 */
Route::middleware(['auth'])->group(function(){
    Route::get('/', 'HomepageController@index')->name('homepage');
    /**
     * 系统配置获取和提交路由
     */
    Route::match(['get', 'post'], '/system/setting', 'SettingController@systemSetting')->name('system_setting');

    /**
     * 物流设置获取和提交路由
     */
    Route::match(['get', 'post'], '/shipping/setting', 'SettingController@shippingSetting')->name('shipping_setting');

    /**
     * 物流数据导入相关路由
     */
    Route::get('/importer/{type}', 'ImporterController@index')->name('importer');
    Route::get('/importer/{type}/show', 'ImporterController@show')->name('importer_show');
    Route::post('/preImport/{type}', 'ImporterController@preImport')->name('pre_import');
    Route::post('/import/{type}', 'ImporterController@import')->name('import');

    /**
     * 价格计算器路由
     */
    Route::get('/shipping', 'ShippingController@index')->name('shipping');

    /**
     * 用户管理路由
     */
    Route::get('/user', 'UserController@index')->name('user');
    Route::match(['get', 'post'], '/user/create', 'UserController@create')->name('user_create');
    Route::get('/user/nickname/check', 'UserController@checkNickname')->name('user_nickname_check');
    Route::get('/user/mobile/check', 'UserController@checkMobile')->name('user_mobile_check');
    Route::get('/user/email/check', 'UserController@checkEmail')->name('user_email_check');
    Route::get('/user/importer/show', 'UserController@userImporterShow')->name('user_importer_show');
    Route::post('/user/import', 'UserController@userImport')->name('user_import');

    /**
     * 我的相关路由
     */
    Route::match(['get', 'post'], '/my/homepage', 'MyController@homepage')->name('my_homepage');
    Route::match(['get', 'post'], '/my/password/change', 'MyController@changePassword')->name('my_password_change');
    Route::get('/my/password/check', 'MyController@checkCurrentPassword')->name('my_password_check');

    /**
     * 花名册相关路由
     */
    Route::get('/roster', 'RosterController@index')->name('roster');

    /**
     * 用户主页路由
     */
    Route::get('user/{id}/homepage', 'UserController@homepage')->name('user_homepage');
});
