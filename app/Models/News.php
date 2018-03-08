<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    const CATEGORY_ID_NEWS   = 1;
    const CATEGORY_ID_PUBLIC = 2;

    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;

    public static $categorys = [
        self::CATEGORY_ID_NEWS   => '新闻',
        self::CATEGORY_ID_PUBLIC => '公告',
    ];

    public static $status = [
        self::STATUS_ENABLED => '显示',
        self::STATUS_DISABLED => '隐藏',
    ];

    protected $fillable = ['category_id', 'title', 'keywords', 'description', 'content', 'admin_id' ,'slug'];
}
