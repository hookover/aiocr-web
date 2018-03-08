<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGift extends Model
{
    // 隐藏不必须字段
    protected $hidden = [

    ];

    protected $guarded = ['id'];

    const STATUS_ENABLED  = 1;   //启用
    const STATUS_DISABLED = 2;   //禁用

    const TYPE_USER      = 1;   //用户
    const TYPE_DEVELOPER = 2;   //作者
    const TYPE_ALL       = 3;   //两者都


    public static $status = [
        self::STATUS_ENABLED  => '启用',
        self::STATUS_DISABLED => '禁用',
    ];

    public static $types = [
        self::TYPE_USER      => '用户专用',
        self::TYPE_DEVELOPER => '开发者专用',
        self::TYPE_ALL       => '通用',
    ];

}
