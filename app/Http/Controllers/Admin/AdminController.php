<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $admin = Admin::where('admin_id', 'LIKE', "%$keyword%")
                ->orWhere('username', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('status_account', 'LIKE', "%$keyword%")
                ->orWhere('count_login', 'LIKE', "%$keyword%")
                ->orWhere('ip_last_login', 'LIKE', "%$keyword%")
                ->orWhere('time_last_login', 'LIKE', "%$keyword%")
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } else {
            $admin = Admin::orderBy('created_at', 'desc')->paginate($perPage);
        }

        foreach ($admin as $item) {
            $item->status_account = Admin::$status[$item->status_account];
        }

        return view('admin.admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.admin.create');
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
        
        Admin::create($requestData);

        return redirect('admin/admin')->with('flash_message', 'Admin added!');
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
        $admin = Admin::findOrFail($id);

        return view('admin.admin.show', compact('admin'));
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
        $admin = Admin::findOrFail($id);

        return view('admin.admin.edit', compact('admin'));
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
//        $admin = Admin::findOrFail($id);
//        $admin->update($requestData);

        return redirect('admin/admin')->with('flash_message', '不可编辑!');
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
//        Admin::destroy($id);

        return redirect('admin/admin')->with('flash_message', '不可删除!');
    }
}
