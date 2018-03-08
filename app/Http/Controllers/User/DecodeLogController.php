<?php

namespace App\Http\Controllers\User;

use App\Models\File;
use App\Repositories\ServerIDRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as BaseController;

class DecodeLogController extends BaseController
{
    public function index(Request $request)
    {
        $req_params = [
            'page_size' => $request->get('page_size') ? $request->input('page_size') : '15',
            'type'      => $request->get('type') ? $request->get('type') : 0,
            'date_from' => $request->get('date_from') ? $request->get('date_from') : null,
            'date_to'   => $request->get('date_to') ? $request->get('date_to') : null,
        ];

        $wheres[] = ['user_id', '=', Auth::user()->user_id];    //当前用户
        // 状态
        if ($req_params['type']) {
            $wheres[] = ['type', '=', $req_params['type']];
        }

        // 开始时间限制
        if ($req_params['date_from']) {
            $wheres[] = ['created_at', '>=', date('Y-m-d H:i:s', strtotime($req_params['date_from']))];
        }

        // 结束时间限制
        if ($req_params['date_to']) {
            $wheres[] = ['created_at', '<=', date('Y-m-d H:i:s', strtotime("{$req_params['date_to']} + 1 day") - 1)];
        }


        $files = File::select(['id_a', 'id_b', 'server_id', 'ip', 'path', 'status', 'result', 'report', 'updated_at', 'created_at', 'file_type_id', 'app_id', 'cost'])
            ->where($wheres)
            ->orderBy('id_a', 'desc')
            ->simplePaginate($req_params['page_size']);

        foreach ($files as $file) {
            $file->url         = ServerIDRepository::generateImageUrlByFile($file);
            $file->id          = $file->id_a . $file->id_b;
            $file->ip          = long2ip($file->ip);
            $file->status_name = File::$status[ $file->status ];
            if ($file->report == File::REPORT_STATUS_YES) {
                $file->status_name = File::$report_status[ File::REPORT_STATUS_YES ];
            }
        }

        return view('backend.decode-log', ['data' => $files]);
    }
}
