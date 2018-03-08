<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;

class UserLogController extends Controller
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
            'user_id'   => $request->get('user_id') ? $request->get('user_id') : '',
            'type'      => $request->get('type') ? $request->get('type') : '',
            'date_from' => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'   => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres[] = ['id', '>=', 1];

        if($from['user_id']){
            $wheres[] = ['user_id', '=', $from['user_id']];
        }

        if($from['type']){
            $wheres[] = ['type', '=', $from['type']];
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

        $user_log = UserLog::where($wheres)->orderBy('created_at', 'desc')->paginate($perPage);

//        if (!empty($keyword)) {
//            $user_log = UserLog::where('id', 'LIKE', "%$keyword%")
//                ->orWhere('user_id', 'LIKE', "%$keyword%")
//                ->orWhere('type', 'LIKE', "%$keyword%")
//                ->orWhere('desc', 'LIKE', "%$keyword%")
//                ->orWhere('browser_info', 'LIKE', "%$keyword%")
//                ->orWhere('ip', 'LIKE', ip2long("%$keyword%"))
//                ->orWhere('created_at', 'LIKE', "%$keyword%")
//                ->orderBy('created_at', 'desc')
//                ->paginate($perPage);
//        } else {
//            $user_log = UserLog::orderBy('created_at', 'desc')->paginate($perPage);
//        }

        foreach ($user_log as $item) {
            $item->type = UserLog::$types[ $item->type ];
            $item->ip   = long2ip($item->ip);
        }

        return view('admin.user_log.index', compact('user_log'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user_log.create');
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

//        $requestData = $request->all();
//
//        UserLog::create($requestData);

        return redirect('admin/user_log')->with('flash_message', '不可创建!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user_log = UserLog::findOrFail($id);

        return view('admin.user_log.show', compact('user_log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user_log = UserLog::findOrFail($id);

        return view('admin.user_log.edit', compact('user_log'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

//        $requestData = $request->all();
//
//        $user_log = UserLog::findOrFail($id);
//        $user_log->update($requestData);

        return redirect('admin/user_log')->with('flash_message', '不可编辑!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
//        UserLog::destroy($id);

        return redirect('admin/user_log')->with('flash_message', '不可删除!');
    }
}
