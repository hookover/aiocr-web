<?php

namespace App\Http\Controllers\User;

use App\Models\StatisticalReportsUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatisticalReportsUserController extends Controller
{
    public function statisticalReports(Request $request)
    {
        $user_id = Auth::user()->user_id;

        $statisticalReportsUsers = StatisticalReportsUser::where('user_id', '=', $user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('backend.statisticalReports', ['data' => $statisticalReportsUsers]);
    }
}
