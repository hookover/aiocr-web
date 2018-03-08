<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
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
            'payment_id' => $request->get('payment_id') ? $request->get('payment_id') : '',
            'ip'         => $request->get('ip') ? $request->get('ip') : '',
            'uid'        => $request->get('uid') ? $request->get('uid') : '',
            'status'     => $request->get('status') ? $request->get('status') : '',
            'date_from'  => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'    => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres[] = ['id', '>=', 1];

        if($from['payment_id']){
            $wheres[] = ['payment_id', 'like', "%{$from['payment_id']}%"];
        }

        if($from['ip']){
            $wheres[] = ['ip', '=', $from['ip']];
        }

        if($from['uid']){
            $wheres[] = ['uid', '=', $from['uid']];
        }

        if($from['status']){
            $wheres[] = ['status', '=', $from['status']];
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

        $payment = Payment::where($wheres)->orderBy('created_at', 'desc')->paginate($perPage);

//        if (!empty($keyword)) {
//            $payment = Payment::where('id', 'LIKE', "%$keyword%")
//                ->orWhere('payment_id', 'LIKE', "%$keyword%")
//                ->orWhere('pay_channel_id', 'LIKE', "%$keyword%")
//                ->orWhere('trade_no', 'LIKE', "%$keyword%")
//                ->orWhere('user_type', 'LIKE', "%$keyword%")
//                ->orWhere('uid', 'LIKE', "%$keyword%")
//                ->orWhere('money', 'LIKE', "%$keyword%")
//                ->orWhere('actual_money', 'LIKE', "%$keyword%")
//                ->orWhere('point', 'LIKE', "%$keyword%")
//                ->orWhere('point_before', 'LIKE', "%$keyword%")
//                ->orWhere('point_after', 'LIKE', "%$keyword%")
//                ->orWhere('description', 'LIKE', "%$keyword%")
//                ->orWhere('admin_id', 'LIKE', "%$keyword%")
//                ->orWhere('status', 'LIKE', "%$keyword%")
//                ->orWhere('ip', 'LIKE', "%$keyword%")
//                ->orWhere('done_at', 'LIKE', "%$keyword%")
//                ->orWhere('created_at', 'LIKE', "%$keyword%")
//                ->orderBy('created_at', 'desc')
//                ->paginate($perPage);
//        } else {
//            $payment = Payment::orderBy('created_at', 'desc')->paginate($perPage);
//        }

        foreach ($payment as $item) {
            $item->status_name      = Payment::$status[ $item->status ];
            $item->pay_channel_name = Payment::$channels[ $item->pay_channel_id ];
            $item->user_type        = Payment::$user_types[ $item->user_type ];
        }


        return view('admin.payment.index', compact('payment'));
    }

    public function adminPay(Request $request)
    {
        $user_type    = $request->input('user_type');
        $uid          = $request->input('uid');
        $money        = $request->input('money');
        $actual_money = $request->input('actual_money');
        $description  = $request->input('description');

        Validator::make(
            [
                'user_type'    => $user_type,
                'uid'          => $uid,
                'money'        => $money,
                'actual_money' => $actual_money,
                'description'  => $description,
            ],
            [
                'user_type'    => 'required|numeric|min:0',
                'uid'          => 'required|numeric|min:1',
                'money'        => 'required|numeric|min:0.01',
                'actual_money' => 'required|numeric|min:0',
                'description'  => 'max:256',
            ]
        )->validate();

        DB::beginTransaction();
        try {
            $payment = PaymentRepository::createAdminPay($request);
            if ($payment) {
                PaymentRepository::createPaymentGift($request, $payment);

                $status = PaymentRepository::paymentSuccess($payment->payment_id);

                if ($status) {
                    DB::commit();

                    return $this->responseSuccess('成功充值 ￥' . $payment->money);
                }
            }

            DB::rollBack();

            return $this->responseError('转帐记录添加失败，请联系管理员！');

        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->responseError($exception->getMessage());
        }
    }

    public function confirmBankTransfer(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'type'       => [
                    'required',
                    Rule::in(['pass', 'refusal']),
                ],
                'payment_id' => 'required|string|min:26|max:36',
            ]
        )->validate();

        $type        = $request->input('type');
        $payment_id  = $request->input('payment_id');
        $description = $request->input('description');

        if ($type == 'pass') {
            PaymentRepository::paymentSuccess($payment_id, null, Auth::user()->admin_id);
        }

        if ($type == 'refusal') {
            PaymentRepository::paymentFail($payment_id, $description, Auth::user()->admin_id);
        }

        return $this->responseSuccess('处理完成');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.payment.create');
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
//        Payment::create($requestData);

        return redirect('admin/payment')->with('flash_message', '开玩笑，这个记录能手工创造？!');
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
        $payment = Payment::findOrFail($id);

        return view('admin.payment.show', compact('payment'));
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
        $payment = Payment::findOrFail($id);

        return view('admin.payment.edit', compact('payment'));
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
//        $payment = Payment::findOrFail($id);
//        $payment->update($requestData);

        return redirect('admin/payment')->with('flash_message', '我会让你编辑？!');
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
        return redirect('admin/payment')->with('flash_message', '不可删除!');
    }
}
