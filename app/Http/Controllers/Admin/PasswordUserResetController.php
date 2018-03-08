<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PasswordUserReset;
use Illuminate\Http\Request;

class PasswordUserResetController extends Controller
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
            $password_user_reset = PasswordUserReset::where('email', 'LIKE', "%$keyword%")
                ->orWhere('api_token', 'LIKE', "%$keyword%")
                ->orWhere('created_at', 'LIKE', "%$keyword%")
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } else {
            $password_user_reset = PasswordUserReset::orderBy('created_at', 'desc')->paginate($perPage);
        }

        return view('admin.password_user_reset.index', compact('password_user_reset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.password_user_reset.create');
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
        
        PasswordUserReset::create($requestData);

        return redirect('admin/password_user_reset')->with('flash_message', 'PasswordUserReset added!');
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
        $password_user_reset = PasswordUserReset::findOrFail($id);

        return view('admin.password_user_reset.show', compact('password_user_reset'));
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
        $password_user_reset = PasswordUserReset::findOrFail($id);

        return view('admin.password_user_reset.edit', compact('password_user_reset'));
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
        
        $password_user_reset = PasswordUserReset::findOrFail($id);
        $password_user_reset->update($requestData);

        return redirect('admin/password_user_reset')->with('flash_message', 'PasswordUserReset updated!');
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
        PasswordUserReset::destroy($id);

        return redirect('admin/password_user_reset')->with('flash_message', 'PasswordUserReset deleted!');
    }
}
