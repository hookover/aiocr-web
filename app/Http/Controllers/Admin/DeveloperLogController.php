<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Developer;
use App\Models\DeveloperLog;
use Illuminate\Http\Request;

class DeveloperLogController extends Controller
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
            'developer_id' => $request->get('developer_id') ? $request->get('developer_id') : '',
            'type'         => $request->get('type') ? $request->get('type') : '',
            'date_from'    => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'      => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres[] = ['id', '>=', 1];

        if($from['developer_id']){
            $wheres[] = ['developer_id', '=', $from['developer_id']];
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

        $developer_log = DeveloperLog::where($wheres)->orderBy('created_at', 'desc')->paginate($perPage);

//        if (!empty($keyword)) {
//            $developer_log = DeveloperLog::where('id', 'LIKE', "%$keyword%")
//                ->orWhere('developer_id', 'LIKE', "%$keyword%")
//                ->orWhere('type', 'LIKE', "%$keyword%")
//                ->orWhere('desc', 'LIKE', "%$keyword%")
//                ->orWhere('browser_info', 'LIKE', "%$keyword%")
//                ->orWhere('ip', 'LIKE', ip2long("%$keyword%"))
//                ->orWhere('created_at', 'LIKE', "%$keyword%")
//                ->orderBy('created_at', 'desc')
//                ->paginate($perPage);
//        } else {
//            $developer_log = DeveloperLog::orderBy('created_at', 'desc')->paginate($perPage);
//        }

        foreach ($developer_log as $item) {
            $item->type = DeveloperLog::$types[ $item->type ];
            $item->ip   = long2ip($item->ip);
        }

        return view('admin.developer_log.index', compact('developer_log'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.developer_log.create');
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
//        DeveloperLog::create($requestData);

        return redirect('admin/developer_log')->with('flash_message', '不可创建!');
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
        $developer_log = DeveloperLog::findOrFail($id);

        return view('admin.developer_log.show', compact('developer_log'));
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
        $developer_log = DeveloperLog::findOrFail($id);

        return view('admin.developer_log.edit', compact('developer_log'));
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
//        $developer_log = DeveloperLog::findOrFail($id);
//        $developer_log->update($requestData);

        return redirect('admin/developer_log')->with('flash_message', '不可编辑!');
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
//        DeveloperLog::destroy($id);

        return redirect('admin/developer_log')->with('flash_message', '不可删除!');
    }
}
