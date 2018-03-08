<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Card;
use App\Repositories\CardRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Excel;

class CardController extends BaseController
{
    public function card()
    {
        $developer_id = Auth::user()->developer_id;

        $cards = Card::select(['user_id', 'card', 'point', 'money', 'status', 'created_at', 'time_used'])
            ->orderBy('created_at', 'desc')
            ->where([['developer_id', '=', $developer_id]])
            ->paginate(10);
        foreach ($cards as $card) {
            $card->status_name = Card::$status[ $card->status ];
        }

        return view('backend.developer.card', ['data' => $cards]);
    }

    public function create(Request $request)
    {
        $number     = $request->input('number');
        $card_money = $request->input('card_money');

        #充值点数+分成点数
        $current_point = $request->user()->point_pay_current + $request->user()->point_dividend_current;
        if ($current_point == 0) {
            return redirect()->back()->withInput()->with('warning', '帐户余额点数不足，请先充值~');
        }

        Validator::make(
            ['number' => $number, 'card_money' => $card_money],
            [
                'number'     => 'required|numeric|min:1',
                'card_money' => 'required|numeric|min:1|max:10000',
            ]
        )->validate();

        #计算金额
        $money          = intval($number) * intval($card_money);
        $money_to_point = $money * env('MONEY_TO_POINT_PAY');

        if (!$money_to_point) {
            return redirect()->back()->withInput()->with('warning', '汇率未配置！！！');
        }

        if ($money_to_point > $current_point) {
            return redirect()->back()->withInput()->with('warning', '帐户余额不足！！！');
        }

        $res = CardRepository::createCardByNumber($request, $money_to_point);

        if ($res) {
            return redirect()->back()->withInput()->with('success', '恭喜，生成成功！！');
        }

        return redirect()->back()->withInput()->with('warning', '嘎？生成失败，最好联系一下管理员。');
    }

    public function exportExcel($status = null)
    {
        $developer_id = Auth::user()->developer_id;

        $whiles = [['developer_id', '=', $developer_id]];
        if ($status) {
            $whiles[] = ['status', '=', $status];
        }


        $cards = Card::select(['card', 'point', 'money', 'status', 'created_at', 'user_id', 'time_used'])
            ->orderBy('created_at', 'desc')
            ->where($whiles)
            ->get();
        foreach ($cards as $card) {
            $card->status = Card::$status[ $card->status ];
        }
        $file_name = date('YmdHis') . '_' . $status;
        $cards     = array_merge([['卡号', '点数', '面额', '状态', '创建时间', '使用人ID', '使用时间']], $cards->toArray());

        Excel::create($file_name, function ($excel) use ($cards) {
            $excel->sheet('score', function ($sheet) use ($cards) {
                $sheet->rows($cards);
            });
        })->export('csv');
    }
}
