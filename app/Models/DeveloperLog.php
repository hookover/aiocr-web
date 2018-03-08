<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeveloperLog extends Model
{
    const LOG_STATUS_LOGIN_SUCCESS     = 10;  //登录成功
    const LOG_STATUS_LOGIN_FAIL        = 20;  //登录失败
    const LOG_STATUS_FORGET_PWD        = 30;  //找回密码
    const LOG_STATUS_CHANGE_PWD        = 40;  //修改密码
    const LOG_STATUS_UPDATE_INFO       = 50;  //更新个人信息
    const LOG_STATUS_UPDATE_INFO_EMAIL = 51;  //更新个人信息邮箱
    const LOG_STATUS_UPDATE_INFO_PHONE = 52;  //更新个人信息手机
    const LOG_STATUS_LOCKING_POINT     = 60;  //锁定积分
    const LOG_STATUS_UNLOCKING_POINT   = 70;  //解锁积分

    protected $hidden = [

    ];

    protected $fillable = [
        'developer_id',
        'type',
        'desc',
        'browser_info',
        'ip',
    ];

    public static $types = [
        self::LOG_STATUS_LOGIN_SUCCESS     => '登录成功',
        self::LOG_STATUS_LOGIN_FAIL        => '登录失败',
        self::LOG_STATUS_FORGET_PWD        => '找回密码',
        self::LOG_STATUS_CHANGE_PWD        => '修改密码',
        self::LOG_STATUS_UPDATE_INFO       => '更新个人信息',
        self::LOG_STATUS_UPDATE_INFO_EMAIL => '更新个人信息邮箱',
        self::LOG_STATUS_UPDATE_INFO_PHONE => '更新个人信息手机',
        self::LOG_STATUS_LOCKING_POINT     => '锁定积分',
        self::LOG_STATUS_UNLOCKING_POINT   => '解锁积分',
    ];
}
