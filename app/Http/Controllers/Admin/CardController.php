<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
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
            'developer_id' => $request->get('developer_id') ? $request->get('developer_id') : '',
            'user_id'      => $request->get('user_id') ? $request->get('user_id') : '',
            'status'       => $request->get('status') ? $request->get('status') : '',
            'date_from'    => $request->get('date_from') ? $request->get('date_from') : '',
            'date_to'      => $request->get('date_to') ? $request->get('date_to') : '',
        ];

        $wheres[] = ['id', '>=', 1];

        if($from['developer_id']){
            $wheres[] = ['developer_id', '=', "{$from['developer_id']}"];
        }

        if($from['user_id']){
            $wheres[] = ['user_id', '=', $from['user_id']];
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

        $card = Card::where($wheres)->orderBy('created_at', 'desc')->paginate($perPage);

//        if (!empty($keyword)) {
//            $card = Card::where('id', 'LIKE', "%$keyword%")
//                ->orWhere('developer_id', 'LIKE', "%$keyword%")
//                ->orWhere('user_id', 'LIKE', "%$keyword%")
//                ->orWhere('point_before', 'LIKE', "%$keyword%")
//                ->orWhere('point_after', 'LIKE', "%$keyword%")
//                ->orWhere('card', 'LIKE', "%$keyword%")
//                ->orWhere('point', 'LIKE', "%$keyword%")
//                ->orWhere('money', 'LIKE', "%$keyword%")
//                ->orWhere('ip_used', 'LIKE', "%$keyword%")
//                ->orWhere('ip_created', 'LIKE', "%$keyword%")
//                ->orWhere('status', 'LIKE', "%$keyword%")
//                ->orWhere('time_used', 'LIKE', "%$keyword%")
//                ->orWhere('created_at', 'LIKE', "%$keyword%")
//                ->orderBy('created_at', 'desc')
//                ->paginate($perPage);
//        } else {
//            $card = Card::orderBy('created_at', 'desc')->paginate($perPage);
//        }

        foreach ($card as $item){
            $item->status = Card::$status[$item->status];
        }

        return view('admin.card.index', compact('card'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.card.create');
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
//        Card::create($requestData);

        return redirect('admin/card')->with('flash_message', 'Card added!');
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
        $card = Card::findOrFail($id);

        return view('admin.card.show', compact('card'));
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
        $card = Card::findOrFail($id);

        return view('admin.card.edit', compact('card'));
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

        $card = Card::findOrFail($id);
        $card->update($requestData);

        return redirect('admin/card')->with('flash_message', 'Card updated!');
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
//        Card::destroy($id);

        return redirect('admin/card')->with('flash_message', '不可以删除！');
    }
}
