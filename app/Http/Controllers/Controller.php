<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($message = '成功', array $data = [], $status_code = 200)
    {
        return response()->json([
            'message'     => $message,
            'status_code' => $status_code,
            'data'        => $data,
        ]);
    }

    public function responseError($message = "失败", $status_code = 500)
    {
        return response()->json([
            'message'     => $message,
            'status_code' => $status_code,
        ], $status_code);
    }
}
