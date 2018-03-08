<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StatisticalReportsAdmin;
use Illuminate\Http\Request;

class StatisticalReportsAdminController extends Controller
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
            'date_from'    => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'      => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres = [];

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
            $statistical_reports_admin = StatisticalReportsAdmin::where($wheres)->paginate($perPage);
        } else {
            $statistical_reports_admin = StatisticalReportsAdmin::paginate($perPage);
        }

        return view('admin.statistical_reports_admin.index', compact('statistical_reports_admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.statistical_reports_admin.create');
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
//        StatisticalReportsAdmin::create($requestData);

        return redirect('admin/statistical_reports_admin')->with('flash_message', 'StatisticalReportsAdmin added!');
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
        $statistical_reports_admin = StatisticalReportsAdmin::findOrFail($id);

        return view('admin.statistical_reports_admin.show', compact('statistical_reports_admin'));
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
        $statistical_reports_admin = StatisticalReportsAdmin::findOrFail($id);

        return view('admin.statistical_reports_admin.edit', compact('statistical_reports_admin'));
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
//        $statistical_reports_admin = StatisticalReportsAdmin::findOrFail($id);
//        $statistical_reports_admin->update($requestData);

        return redirect('admin/statistical_reports_admin')->with('flash_message', 'StatisticalReportsAdmin updated!');
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
//        StatisticalReportsAdmin::destroy($id);

        return redirect('admin/statistical_reports_admin')->with('flash_message', 'StatisticalReportsAdmin deleted!');
    }
}
