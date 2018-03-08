<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PasswordDeveloperReset;
use Illuminate\Http\Request;

class PasswordDeveloperResetController extends Controller
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
            $password_developer_reset = PasswordDeveloperReset::where('email', 'LIKE', "%$keyword%")
                ->orWhere('api_token', 'LIKE', "%$keyword%")
                ->orWhere('created_at', 'LIKE', "%$keyword%")
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } else {
            $password_developer_reset = PasswordDeveloperReset::orderBy('created_at', 'desc')->paginate($perPage);
        }

        return view('admin.password_developer_reset.index', compact('password_developer_reset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.password_developer_reset.create');
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
        
        PasswordDeveloperReset::create($requestData);

        return redirect('admin/password_developer_reset')->with('flash_message', 'PasswordDeveloperReset added!');
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
        $password_developer_reset = PasswordDeveloperReset::findOrFail($id);

        return view('admin.password_developer_reset.show', compact('password_developer_reset'));
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
        $password_developer_reset = PasswordDeveloperReset::findOrFail($id);

        return view('admin.password_developer_reset.edit', compact('password_developer_reset'));
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
        
        $password_developer_reset = PasswordDeveloperReset::findOrFail($id);
        $password_developer_reset->update($requestData);

        return redirect('admin/password_developer_reset')->with('flash_message', 'PasswordDeveloperReset updated!');
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
        PasswordDeveloperReset::destroy($id);

        return redirect('admin/password_developer_reset')->with('flash_message', 'PasswordDeveloperReset deleted!');
    }
}
