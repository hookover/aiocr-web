<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Developer;
use App\Models\Payment;
use App\Models\StatisticalReportsAdmin;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    public function dashboard(Request $request)
    {

        $user_24hours_count      = User::where('created_at', '>', date('Y-m-d H:i:s', time() - 86400))->count('id');
        $developer_24hours_count = Developer::where('created_at', '>', date('Y-m-d H:i:s', time() - 86400))->count('id');

        $payment_money_total = Payment::where([
            ['done_at', '>', date('Y-m-d H:i:s', time() - 86400)],
            ['money', '>', 0],
        ])->sum('money');

        $payment_actual_money_total = Payment::where([
            ['done_at', '>', date('Y-m-d H:i:s', time() - 86400)],
            ['actual_money', '>', 0],
        ])->sum('actual_money');

        $withdraw_count = Withdraw::where([
            ['status', '=', Withdraw::STATUS_CREATED],
        ])->count('id');


        return view('admin.dashboard', [
            'data' => [
                'user_count'         => $user_24hours_count,
                'developer_count'    => $developer_24hours_count,
                'money_total'        => $payment_money_total,
                'money_actual_total' => $payment_actual_money_total,
                'withdraw_count'     => $withdraw_count,
            ],
        ]);
    }

    public function statistics()
    {
        $statisticalReports = \Cache::store('file')->remember('admin_dashboard_statistics', 5, function (){
            $reports =  StatisticalReportsAdmin::where('created_at', '>' , (time() - 86400))->get();
            $data = [];
            foreach ($reports as $report) {
                $date_key = strtotime(date('Y-m-d H:00:00', $report->created_at));
                if(!array_key_exists($date_key, $data)) {

                    $data[$date_key] = [
                        'numbers' => 0,
                        'points'  => 0
                    ];
                }
                $data[$date_key]['numbers'] += $report->number;
                $data[$date_key]['points'] += $report->points;
            }
            return $data;
        });

        return $this->responseSuccess('success',$statisticalReports);
    }
}
