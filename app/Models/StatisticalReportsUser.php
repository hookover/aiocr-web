<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticalReportsUser extends Model
{
    protected $table = 'statistical_reports_user';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'int'
    ];
}
