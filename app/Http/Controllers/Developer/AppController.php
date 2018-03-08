<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller as BaseController;
use App\Models\App;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AppController extends BaseController
{
    public function app()
    {
        $developer_id = Auth::user()->developer_id;

        $apps = App::select(['app_id', 'app_key', 'name', 'status', 'created_at'])
            ->where([['developer_id', '=', $developer_id]])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        foreach ($apps as $app) {
            $app->status = App::$status[ $app->status ];
        }

        return view('backend.developer.app', ['data' => $apps]);
    }


    public function create(Request $request)
    {
        $app_name = $request->input('app_name');

        Validator::make(
            ['app_name' => $app_name],
            ['app_name' => 'required|string|min:2|max:32']
        )->validate();


        $app = AppRepository::create($request);

        if ($app) {
            return redirect()->back()->withInput()->with('success', '软件创建成功！');
        }

        return redirect()->back()->withInput()->with('error', '软件创建失败！');
    }
}
