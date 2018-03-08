<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerID extends Model
{
    protected $table = 'server_ids';

    protected $guarded = [
        'preparation_a',
        'preparation_b',
        'preparation_c',
        'preparation_d',
        'preparation_e',
    ];

    //状态
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;

    //提现渠道
    const SERVER_TYPE_UNIVERSAL = 1;
    const SERVER_TYPE_LOGIN     = 2;
    const SERVER_TYPE_UPLOAD    = 3;
    const SERVER_TYPE_RESULT    = 4;
    const SERVER_TYPE_REPORT    = 5;

    public static $status = [
        self::STATUS_ENABLED  => '启用',
        self::STATUS_DISABLED => '禁用',
    ];

    public static $SERVER_TYPEs = [
        self::SERVER_TYPE_UNIVERSAL => '通用型',
        self::SERVER_TYPE_LOGIN     => '登录服务器',
        self::SERVER_TYPE_UPLOAD    => '上传服务器',
        self::SERVER_TYPE_RESULT    => '获取结果服务器',
        self::SERVER_TYPE_REPORT    => '报错服务器',
    ];
}

