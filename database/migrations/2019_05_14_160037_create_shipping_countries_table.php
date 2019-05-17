<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_countries', function (Blueprint $table) {
            $table->increments('id')->comment('物流国家ID');
            $table->string('name_cn', 255)->unique()->comment('国家中文名称');
            $table->string('name_en', 255)->unique()->comment('国家英文名称');
            $table->string('number', 32)->unique()->comment('国家名称编码');
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
        Schema::dropIfExists('shipping_countries');
    }
}
