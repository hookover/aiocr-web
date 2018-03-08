<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StatisticalReportsUser;
use Illuminate\Http\Request;

class StatisticalReportsUserController extends Controller
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
            'user_id' => $request->get('user_id') ? $request->get('user_id') : '',
            'date_from'    => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'      => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres = [];

        if($from['user_id']){
            $wheres[] = ['user_id', '=', $from['user_id']];
        }

        // 开始时间限制
        if($from['date_from']){
            $wheres[] = ['created_at', '>=', strtotime($from['date_from'])];
        }

        // 结束时间限制
        if($from['date_to']){
            $wheres[] = ['created_at', '<=', strtotime("{$from['date_to']} + 1 day") - 1];
        }

        $perPage = 15;

        if (!empty($wheres)) {
            $statistical_reports_user = StatisticalReportsUser::where($wheres)
                ->paginate($perPage);
        } else {
            $statistical_reports_user = StatisticalReportsUser::paginate($perPage);
        }

        return view('admin.statistical_reports_user.index', compact('statistical_reports_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.statistical_reports_user.create');
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
//        StatisticalReportsUser::create($requestData);

        return redirect('admin/statistical_reports_user')->with('flash_message', 'StatisticalReportsUser added!');
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
        $statistical_reports_user = StatisticalReportsUser::findOrFail($id);

        return view('admin.statistical_reports_user.show', compact('statistical_reports_user'));
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
        $statistical_reports_user = StatisticalReportsUser::findOrFail($id);

        return view('admin.statistical_reports_user.edit', compact('statistical_reports_user'));
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
        
//        $requestData = $request->all();
//
//        $statistical_reports_user = StatisticalReportsUser::findOrFail($id);
//        $statistical_reports_user->update($requestData);

        return redirect('admin/statistical_reports_user')->with('flash_message', 'StatisticalReportsUser updated!');
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
//        StatisticalReportsUser::destroy($id);

        return redirect('admin/statistical_reports_user')->with('flash_message', 'StatisticalReportsUser deleted!');
    }
}
