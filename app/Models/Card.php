<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    // 隐藏不必须字段
    protected $hidden = [

    ];

    protected $guarded = ['id'];

    const CARD_VALID     = 1;   //有效
    const CARD_IS_USED   = 2;   //已使用
    const CARD_NOT_VALID = 3;   //被废除

    public static $status = [
        self::CARD_VALID     => '有效',
        self::CARD_IS_USED   => '已使用',
        self::CARD_NOT_VALID => '被废除',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function developer()
    {
        return $this->belongsTo('App\Models\Developer', 'developer_id', 'developer_id');
    }
}
