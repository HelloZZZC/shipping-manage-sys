<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /**
     * 物流表
     * @var string
     */
    protected $table = 'shippings';

    protected $fillable = [
        'type', 'country_id', 'cost',
    ];
}
