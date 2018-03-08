<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [
        'preparation_a',
        'preparation_b',
        'preparation_c',
        'preparation_d',
        'preparation_e',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'salt', 'api_token',
        'preparation_a',
        'preparation_b',
        'preparation_c',
        'preparation_d',
        'preparation_e',
    ];

    const STATUS_ACCOUNT_LOCKED = 0;
    const STATUS_ACCOUNT_VALID  = 1;


    public static $status = [
        self::STATUS_ACCOUNT_LOCKED => '已锁定',
        self::STATUS_ACCOUNT_VALID  => '有效',
    ];
}
