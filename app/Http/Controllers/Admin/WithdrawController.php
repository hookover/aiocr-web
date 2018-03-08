<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Developer;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
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
            'uuid'          => $request->get('uuid') ? $request->get('uuid') : '',
            'developer_id'  => $request->get('developer_id') ? $request->get('developer_id') : '',
            'account'       => $request->get('account') ? $request->get('account') : '',
            'date_from'     => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'       => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres[] = ['status', '=', 1];

        if($from['uuid']){
            $wheres[] = ['uuid', 'like', "%{$from['uuid']}%"];
        }

        if($from['developer_id']){
            $wheres[] = ['developer_id', '=', $from['developer_id']];
        }

        if($from['account']){
            $wheres[] = ['account', '=', $from['account']];
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

        $withdraw = Withdraw::where($wheres)->orderBy('created_at', 'desc')->paginate($perPage);

//        if (!empty($keyword)) {
//            $withdraw = Withdraw::where('status',1)
//                ->orWhere(['id', 'LIKE', "%$keyword%"])
//                ->orWhere('uuid', 'LIKE', "%$keyword%")
//                ->orWhere('developer_id', 'LIKE', "%$keyword%")
//                ->orWhere('channel_id', 'LIKE', "%$keyword%")
//                ->orWhere('real_name', 'LIKE', "%$keyword%")
//                ->orWhere('account', 'LIKE', "%$keyword%")
//                ->orWhere('money', 'LIKE', "%$keyword%")
//                ->orWhere('point', 'LIKE', "%$keyword%")
//                ->orWhere('point_before', 'LIKE', "%$keyword%")
//                ->orWhere('point_after', 'LIKE', "%$keyword%")
//                ->orWhere('description', 'LIKE', "%$keyword%")
//                ->orWhere('admin_id', 'LIKE', "%$keyword%")
//                ->orWhere('status', 'LIKE', "%$keyword%")
//                ->orWhere('ip_created', 'LIKE', "%$keyword%")
//                ->orWhere('ip_admin', 'LIKE', "%$keyword%")
//                ->orWhere('done_at', 'LIKE', "%$keyword%")
//                ->orWhere('created_at', 'LIKE', "%$keyword%")
//                ->orderBy('created_at', 'desc')
//                ->paginate($perPage);
//        } else {
//            $withdraw = Withdraw::where('status',1)->orderBy('created_at', 'desc')->paginate($perPage);
//        }

        foreach($withdraw as $value){
            $value->status = Withdraw::$status[$value->status];
            $value->channel_id = Withdraw::$channels[$value->channel_id];
        }

        return view('admin.withdraw.index', compact('withdraw'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.withdraw.create');
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
//        Withdraw::create($requestData);

        return redirect('admin/withdraw')->with('flash_message', '只能客户创建!');
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
        $withdraw = Withdraw::findOrFail($id);

        return view('admin.withdraw.show', compact('withdraw'));
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
//        $withdraw = Withdraw::findOrFail($id);

//        return view('admin.withdraw.edit', compact('withdraw'));
        return redirect('admin/withdraw')->with('flash_message', '不可编辑!');
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
//        $withdraw = Withdraw::findOrFail($id);
//        $withdraw->update($requestData);

        return redirect('admin/withdraw')->with('flash_message', '不可编辑!');
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
//        Withdraw::destroy($id);

        return redirect('admin/withdraw')->with('flash_message', '不可删除!');
    }

    public function agree(Request $request, $id)
    {
        $withdraw = Withdraw::find($id);
        if(!$withdraw){
            return $this->responseError('该信息不存在');
        }

        if($withdraw->status != 1){
            return $this->responseError('该状态不对');
        }

        $user = Developer::where('developer_id', '=', $withdraw->developer_id)->lockForUpdate()->first();

        if (!$user) {
            return $this->responseError('用户账户不存在');
        }

        $withdraw->admin_id = Auth::user()->admin_id;
        $withdraw->status = 2;
        $withdraw->ip_admin = $request->getClientIp();
        $withdraw->done_at = date('Y-m-d H:i:s', time());
        $result = $withdraw->save();
        if(! $result){
            return $this->responseError('提交失败');
        }

        return $this->responseSuccess('更新成功');
    }

    public function refuse(Request $request,$id)
    {
        $withdraw = Withdraw::find($id);
        if(!$withdraw){
            return $this->responseError('该信息不存在');
        }

        $user = Developer::where('developer_id', '=', $withdraw->developer_id)->lockForUpdate()->first();

        if (!$user) {
            return $this->responseError('用户账户不存在');
        }

        if(!$request->has('description')){
            return $this->responseError('请填写驳回原因');
        }

        //计算点数
        if (!env('MONEY_TO_POINT_WITHDRAW', false)) {
            throw new \Exception('汇率未配置，请联系客服！！！');
        }

        DB::beginTransaction();
        try {
            $current_money_point = intval($withdraw->money * env('MONEY_TO_POINT_WITHDRAW'));
            $point_after = $user->point_dividend_current + $current_money_point;

            $user->point_dividend_current = $point_after;
            $user->save();

            $withdraw->admin_id = Auth::user()->admin_id;
            $withdraw->status = 3;
            $withdraw->description = $request->input('description');
            $withdraw->ip_admin = $request->getClientIp();
            $withdraw->done_at = date('Y-m-d H:i:s', time());
            $result = $withdraw->save();

            if ($result) {
                DB::commit();

                return $this->responseSuccess('更新成功');
            }

            DB::rollBack();

            return $this->responseError('提交失败');

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError('提交失败');
        }
    }
}
