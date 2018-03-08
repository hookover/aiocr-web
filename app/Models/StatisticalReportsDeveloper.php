<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatisticalReportsDeveloper extends Model
{
    protected $table = 'statistical_reports_developer';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'int'
    ];
}
