<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\File;
use App\Repositories\ServerIDRepository;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class FileController extends Controller
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
            'user_id'      => $request->get('user_id') ? $request->get('user_id') : '',
            'date_from'    => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'      => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres[] = ['id_b', '>=', 1];

        if($from['developer_id']){
            $wheres[] = ['developer_id', '=', "{$from['developer_id']}"];
        }

        if($from['user_id']){
            $wheres[] = ['user_id', '=', $from['user_id']];
        }

        // 开始时间限制
        if($from['date_from']){
            $wheres[] = ['id_a', '>=', strtotime($from['date_from'])];
        }

        // 结束时间限制
        if($from['date_to']){
            $wheres[] = ['id_a', '<=', strtotime("{$from['date_to']} + 1 day") - 1];
        }

        $perPage = 15;

        $file = File::where($wheres)->orderBy('id_a', 'desc')->simplePaginate($perPage);

//        if (!empty($keyword)) {
//            $file = File::where('id_a', 'LIKE', "%$keyword%")
//                ->orWhere('url', 'LIKE', "%$keyword%")
//                ->orWhere('status', 'LIKE', "%$keyword%")
//                ->orWhere('result', 'LIKE', "%$keyword%")
//                ->orWhere('file_type_id', 'LIKE', "%$keyword%")
//                ->orWhere('app_id', 'LIKE', "%$keyword%")
//                ->orWhere('user_id', 'LIKE', "%$keyword%")
//                ->orWhere('developer_id', 'LIKE', "%$keyword%")
//                ->orWhere('cost', 'LIKE', "%$keyword%")
//                ->orWhere('ip', 'LIKE', ip2long("%$keyword%"))
//                ->orWhere('created_at', 'LIKE', "%$keyword%")
//                ->orderBy('created_at', 'desc')
//                ->paginate($perPage);
//        } else {
//            $file = File::orderBy('id_a', 'desc')->simplePaginate($perPage);
//        }

        foreach ($file as $item) {
            $item->url    = ServerIDRepository::generateImageUrlByFile($item);
            $item->id     = $item->id_a . $item->id_b;
            $item->status = File::$status[ $item->status ];
            $item->report = File::$report_status[ $item->report ];
            $item->ip     = long2ip($item->ip);
        }

        return view('admin.file.index', compact('file'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.file.create');
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
//
//        $requestData = $request->all();
//
//        File::create($requestData);

        return redirect('admin/file')->with('flash_message', 'File added!');
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
        $file = File::findOrFail($id);


        $file->status = File::$status[ $file->status ];
        $file->report = File::$report_status[ $file->report ];

        return view('admin.file.show', compact('file'));
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
        $file = File::findOrFail($id);

        return view('admin.file.edit', compact('file'));
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
//        $file = File::findOrFail($id);
//        $file->update($requestData);

        return redirect('admin/file')->with('flash_message', 'File updated!');
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
//        File::destroy($id);

        return redirect('admin/file')->with('flash_message', '不可删除！');
    }
}
