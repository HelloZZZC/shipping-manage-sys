<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    /**
     * 汇率表
     * @var string
     */
    protected $table = 'exchange_rates';

    protected $fillable = [
        'from_country', 'to_country', 'rate',
    ];
}
