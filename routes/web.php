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
});
