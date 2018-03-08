<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use SoftDeletes;

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

    //提现状态
    const STATUS_CREATED = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED  = 3;


    //提现渠道
    const CHANNEL_ALIPAY    = 1;
    const CHANNEL_TENPAY    = 2;
    const CHANNEL_WEIXINPAY = 3;
    const CHANNEL_BANK      = 4;


    public static $status = [
        self::STATUS_CREATED => '已申请',
        self::STATUS_SUCCESS => '提现成功',
        self::STATUS_FAILED  => '提现失败',
    ];

    public static $channels = [
        self::CHANNEL_ALIPAY    => '支付宝',
        self::CHANNEL_TENPAY    => '腾讯支付',
        self::CHANNEL_WEIXINPAY => '微信支付',
        self::CHANNEL_BANK      => '银行卡',
    ];
}
