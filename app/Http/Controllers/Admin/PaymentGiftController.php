<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\PaymentGift;
use Illuminate\Http\Request;

class PaymentGiftController extends Controller
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
            $payment_gift = PaymentGift::where('id', 'LIKE', "%$keyword%")
                ->orWhere('condition_money', 'LIKE', "%$keyword%")
                ->orWhere('gift_money', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('expiration', 'LIKE', "%$keyword%")
                ->orWhere('created_at', 'LIKE', "%$keyword%")
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } else {
            $payment_gift = PaymentGift::orderBy('created_at', 'desc')->paginate($perPage);
        }

        foreach ($payment_gift as $item) {
            $item->status = PaymentGift::$status[$item->status];
            $item->type = PaymentGift::$types[$item->type];

            if($item->expiration && (strtotime($item->expiration) < time())) {
                $item->expiration = '已过期';
            }

            if(!$item->expiration) {
                $item->expiration = '永不过期';
            }
        }

        return view('admin.payment_gift.index', compact('payment_gift'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.payment_gift.create');
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
        
        PaymentGift::create($requestData);

        return redirect('admin/payment_gift')->with('flash_message', 'PaymentGift added!');
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
        $payment_gift = PaymentGift::findOrFail($id);

        return view('admin.payment_gift.show', compact('payment_gift'));
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
        $payment_gift = PaymentGift::findOrFail($id);

        return view('admin.payment_gift.edit', compact('payment_gift'));
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
        
        $payment_gift = PaymentGift::findOrFail($id);
        $payment_gift->update($requestData);

        return redirect('admin/payment_gift')->with('flash_message', 'PaymentGift updated!');
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
        PaymentGift::destroy($id);

        return redirect('admin/payment_gift')->with('flash_message', 'PaymentGift deleted!');
    }
}
