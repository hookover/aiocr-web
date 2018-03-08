<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileType extends Model
{
    protected $hidden = [

    ];
    protected $guarded = ['id'];

    const STATUS_ENABLE  = 1;   //正常使用
    const STATUS_DISABLE = 0;   //已停止使用

    const AI_PROCESS_ENABLE  = 1;   //启用自动识别
    const AI_PROCESS_DISABLE = 0;   //关闭自动识别


    public static $status = [
        self::STATUS_ENABLE  => '正常',
        self::STATUS_DISABLE => '停止使用',
    ];

    public static $ai_status = [
        self::AI_PROCESS_ENABLE  => '已启用自动识别',
        self::AI_PROCESS_DISABLE => '已关闭自动识别',
    ];
}
