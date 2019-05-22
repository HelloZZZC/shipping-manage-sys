<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id')->comment('对应用户表的ID');
            $table->string('real_name', 64)->default('')->comment('用户真实姓名');
            $table->integer('age', false, true)->nullable()->comment('用户年龄');
            $table->string('gender', 32)->default('secret')->comment('用户性别');
            $table->string('address', 255)->default('')->comment('用户现居地址');
            $table->string('birthday', 16)->default('')->comment('用户生日');
            $table->string('graduation', 128)->default('')->comment('用户毕业院校');
            $table->string('job', 64)->default('')->comment('用户岗位工作');
            $table->string('qq', 16)->default('')->comment('用户qq号');
            $table->string('wechat', 64)->default('')->comment('用户微信号');
            $table->text('about')->nullable()->comment('用户简介');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
