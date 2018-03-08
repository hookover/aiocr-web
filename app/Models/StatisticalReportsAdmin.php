<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticalReportsAdmin extends Model
{
    protected $table = 'statistical_reports_admin';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'int'
    ];
}
