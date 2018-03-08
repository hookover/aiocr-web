<?php

namespace App\Http\Controllers\Developer;

use App\Models\StatisticalReportsDeveloper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatisticalReportsDeveloperController extends Controller
{
    public function statisticalReports(Request $request)
    {
        $developer_id = Auth::user()->developer_id;

        $statisticalReportsDevelopers = StatisticalReportsDeveloper::where('developer_id', '=', $developer_id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('backend.statisticalReports', ['data' => $statisticalReportsDevelopers]);
    }
}
