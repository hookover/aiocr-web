<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Models\StatisticalReportsDeveloper;
use App\Models\StatisticalReportsUser;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
     public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function statisticsDeveloper()
    {
        $reports = StatisticalReportsDeveloper::where([
            ['created_at', '>', (time() - 864000)],
            ['developer_id', '=', Auth::user()->developer_id]
        ])->get();
        $data = [];
        if ($reports->count()) {
            foreach ($reports as $report) {
                $date_key = strtotime(date('Y-m-d', $report->created_at));
                if (!array_key_exists($date_key, $data)) {

                    $data[$date_key] = [
                        'numbers' => 0,
                        'points' => 0,
                        'dividend' => 0
                    ];
                }
                $data[$date_key]['numbers'] += $report->number;
                $data[$date_key]['points'] += $report->points;
            }
        }

        return $this->responseSuccess('success',$data);
    }

    public function statisticsUser()
    {
        $reports = StatisticalReportsUser::where([
            ['created_at', '>', (time() - 864000)],
            ['user_id', '=', Auth::user()->user_id]
        ])->get();
        $data = [];
        if ($reports->count()) {
            foreach ($reports as $report) {
                $date_key = strtotime(date('Y-m-d', $report->created_at));
                if (!array_key_exists($date_key, $data)) {

                    $data[$date_key] = [
                        'numbers' => 0,
                        'points' => 0,
                    ];
                }
                $data[$date_key]['numbers'] += $report->number;
                $data[$date_key]['points'] += $report->points;
            }
        }

        return $this->responseSuccess('success',$data);
    }
}
