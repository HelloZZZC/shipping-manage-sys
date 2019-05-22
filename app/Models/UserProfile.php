<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    /**
     * 用户简介表
     * @var string
     */
    protected $table = 'user_profiles';

    protected $fillable = [
        'id',
    ];
}
