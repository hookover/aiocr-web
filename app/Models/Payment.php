<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    // 隐藏不必须字段
    protected $hidden = [

    ];

    protected $casts = [
        'payment_id' => 'string'
    ];
    protected $guarded = [
        'preparation_a',
        'preparation_b',
        'preparation_c',
        'preparation_d',
        'preparation_e',
    ];

    //用户类型
    const TYPE_ACCOUNT_USER      = 1;
    const TYPE_ACCOUNT_DEVELOPER = 2;

    //支付渠道
    const PAY_CHANNEL_ID_ADMIN     = 0; //管理员手工充值
    const PAY_CHANNEL_ID_CARD      = 1; //充值卡
    const PAY_CHANNEL_ID_ALIPAY    = 2; //支付宝
    const PAY_CHANNEL_ID_TENPAY    = 3; //腾讯支付
    const PAY_CHANNEL_ID_WEIXINPAY = 4; //微信
    const PAY_CHANNEL_ID_BANK      = 5; //银行转帐
    const PAY_CHANNEL_ID_GIFT      = 6; //赠送

    //充值状态
    const STATUS_CREATED = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED  = 3;


    public static $status = [
        self::STATUS_CREATED => '已创建',
        self::STATUS_SUCCESS => '充值成功',
        self::STATUS_FAILED  => '充值失败',
    ];


    public static $channels = [
        self::PAY_CHANNEL_ID_ADMIN     => '管理员',
        self::PAY_CHANNEL_ID_CARD      => '充值卡',
        self::PAY_CHANNEL_ID_ALIPAY    => '支付宝',
        self::PAY_CHANNEL_ID_TENPAY    => '腾讯支付',
        self::PAY_CHANNEL_ID_WEIXINPAY => '微信支付',
        self::PAY_CHANNEL_ID_BANK      => '银行汇款',
        self::PAY_CHANNEL_ID_GIFT      => '赠送',
    ];

    public static $user_types = [
        self::TYPE_ACCOUNT_USER      => '用户',
        self::TYPE_ACCOUNT_DEVELOPER => '开发者',
    ];
}
