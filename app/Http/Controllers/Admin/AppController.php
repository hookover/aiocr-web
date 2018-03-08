<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\App;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
//        $keyword = $request->get('search');

        $from = [
            'app_id'      => $request->get('app_id') ? $request->get('app_id') : '',
            'developer_id' => $request->get('developer_id') ? $request->get('developer_id') : '',
            'date_from'    => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'      => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres[] = ['status', '=', 1];

        if($from['app_id']){
            $wheres[] = ['app_id', '=', "{$from['app_id']}"];
        }

        if($from['developer_id']){
            $wheres[] = ['developer_id', '=', "{$from['developer_id']}"];
        }

        // 开始时间限制
        if($from['date_from']){
            $wheres[] = ['created_at', '>=', date('Y-m-d H:i:s', strtotime($from['date_from']))];
        }

        // 结束时间限制
        if($from['date_to']){
            $wheres[] = ['created_at', '<=', date('Y-m-d H:i:s', strtotime("{$from['date_to']} + 1 day") - 1)];
        }

        $perPage = 15;

        $app = App::where($wheres)->orderBy('created_at', 'desc')->paginate($perPage);

//        if (!empty($keyword)) {
//            $app = App::where('app_id', 'LIKE', "%$keyword%")
//                ->orWhere('app_key', 'LIKE', "%$keyword%")
//                ->orWhere('developer_id', 'LIKE', "%$keyword%")
//                ->orWhere('name', 'LIKE', "%$keyword%")
//                ->orWhere('status', 'LIKE', "%$keyword%")
//                ->orWhere('developer_id_created', 'LIKE', "%$keyword%")
//                ->orWhere('ip', 'LIKE', "%$keyword%")
//                ->orWhere('created_at', 'LIKE', "%$keyword%")
//                ->orderBy('created_at', 'desc')
//                ->paginate($perPage);
//        } else {
//            $app = App::orderBy('created_at', 'desc')->paginate($perPage);
//        }

        foreach ($app as $item) {
            $item->status = App::$status[$item->status];
        }

        return view('admin.app.index', compact('app'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.app.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        App::create($requestData);

        return redirect('admin/app')->with('flash_message', 'App added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $app = App::findOrFail($id);

        return view('admin.app.show', compact('app'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $App = App::findOrFail($id);

        return view('admin.app.edit', compact('App'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $app = App::findOrFail($id);
        $app->update($requestData);

        return redirect('admin/app')->with('flash_message', 'App updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
//        App::destroy($id);

        return redirect('admin/app')->with('flash_message', '不可删除!');
    }
}
