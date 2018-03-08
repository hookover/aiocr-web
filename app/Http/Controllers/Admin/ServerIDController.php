<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ServerID;
use Illuminate\Http\Request;

class ServerIDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $server_id = ServerID::where('id', 'LIKE', "%$keyword%")
                ->orWhere('server_id', 'LIKE', "%$keyword%")
                ->orWhere('server_type', 'LIKE', "%$keyword%")
                ->orWhere('server_img_url', 'LIKE', "%$keyword%")
                ->orWhere('server_api_url', 'LIKE', "%$keyword%")
                ->orWhere('server_api_weight', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('created_at', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $server_id = ServerID::paginate($perPage);
        }

        foreach($server_id as $value){
            $value->server_type = ServerID::$SERVER_TYPEs[$value->server_type];
            $value->status = ServerID::$status[$value->status];
        }

        return view('admin.server_id.index', compact('server_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.server_id.create');
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
        
        ServerID::create($requestData);

        return redirect('admin/server_id')->with('flash_message', 'ServerID added!');
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
        $server_id = ServerID::findOrFail($id);
        $server_id->server_type = ServerID::$SERVER_TYPEs[$server_id->server_type];
        $server_id->status = ServerID::$status[$server_id->status];

        return view('admin.server_id.show', compact('server_id'));
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
        $server_id = ServerID::findOrFail($id);

        return view('admin.server_id.edit', compact('server_id'));
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
        
        $server_id = ServerID::findOrFail($id);
        $server_id->update($requestData);

        return redirect('admin/server_id')->with('flash_message', 'ServerID updated!');
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
        ServerID::destroy($id);

        return redirect('admin/server_id')->with('flash_message', 'ServerID deleted!');
    }
}
