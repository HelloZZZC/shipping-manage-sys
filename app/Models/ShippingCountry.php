<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCountry extends Model
{
    /**
     * 物流国家表
     * @var string
     */
    protected $table = 'shipping_countries';

    protected $fillable = [
        'name_cn', 'name_en', 'number',
    ];
}
