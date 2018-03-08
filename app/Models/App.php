<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    // 隐藏不必须字段
    protected $hidden = [

    ];

    protected $guarded = [
        'preparation_a',
        'preparation_b',
        'preparation_c',
        'preparation_d',
        'preparation_e',
    ];

    const STATUS_VALID     = 1; #有效
    const STATUS_NOT_VALID = 2; #无效
    const STATUS_DENY      = 3; #已禁用

    public static $status = [
        self::STATUS_VALID     => '有效',
        self::STATUS_NOT_VALID => '无效',
        self::STATUS_DENY      => '已禁用',
    ];

}
