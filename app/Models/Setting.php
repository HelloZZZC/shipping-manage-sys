<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * 系统配置表
     * @var string
     */
    protected $table = 'settings';

    /**
     * 不维护系统配置表时间戳
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'name', 'value',
    ];
}
