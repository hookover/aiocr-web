<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
            'user_id'      => $request->get('user_id') ? $request->get('user_id') : '',
            'email'       => $request->get('email') ? $request->get('email') : '',
            'date_from'    => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'      => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres[] = ['id', '>=', 1];

        if($from['user_id']){
            $wheres[] = ['user_id', '=', $from['user_id']];
        }

        if($from['email']){
            $wheres[] = ['email', '=', $from['email']];
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

        $user = User::where($wheres)->orderBy('created_at', 'desc')->paginate($perPage);

//        if (!empty($keyword)) {
//            $user = User::where('id', 'LIKE', "%$keyword%")
//                ->orWhere('user_id', 'LIKE', "%$keyword%")
//                ->orWhere('email', 'LIKE', "%$keyword%")
//                ->orWhere('username', 'LIKE', "%$keyword%")
//                ->orWhere('phone', 'LIKE', "%$keyword%")
//                ->orWhere('qq', 'LIKE', "%$keyword%")
//                ->orWhere('alipay', 'LIKE', "%$keyword%")
//                ->orWhere('tenpay', 'LIKE', "%$keyword%")
//                ->orWhere('vip_point', 'LIKE', "%$keyword%")
//                ->orWhere('point_pay_total', 'LIKE', "%$keyword%")
//                ->orWhere('point_pay_current', 'LIKE', "%$keyword%")
//                ->orWhere('point_locked', 'LIKE', "%$keyword%")
//                ->orWhere('status_account', 'LIKE', "%$keyword%")
//                ->orWhere('count_login', 'LIKE', "%$keyword%")
//                ->orWhere('ip_register', 'LIKE', ip2long("%$keyword%"))
//                ->orWhere('ip_pre_login', 'LIKE', ip2long("%$keyword%"))
//                ->orWhere('ip_last_login', 'LIKE', ip2long("%$keyword%"))
//                ->orWhere('time_pre_login', 'LIKE', "%$keyword%")
//                ->orWhere('time_last_login', 'LIKE', "%$keyword%")
//                ->orderBy('created_at', 'desc')
//                ->paginate($perPage);
//        } else {
//            $user = User::orderBy('created_at', 'desc')->paginate($perPage);
//        }

        foreach ($user as $item) {
            $item->status_account = User::$status[$item->status_account];
            $item->ip_register    = long2ip($item->ip_register);
            $item->ip_pre_login   = long2ip($item->ip_pre_login);
            $item->ip_last_login  = long2ip($item->ip_last_login);
        }

        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
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
        
        User::create($requestData);

        return redirect('admin/user')->with('flash_message', 'User added!');
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
        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
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
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
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
        
        $user = User::findOrFail($id);
        $user->update($requestData);

        return redirect('admin/user')->with('flash_message', 'User updated!');
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
//        User::destroy($id);

        return redirect('admin/user')->with('flash_message', '不可删除!');
    }
}
