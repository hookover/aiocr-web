<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\FileType;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.index');
    }

    public function fileType()
    {
        $data = \Cache::store('file')->remember('file_types', 60, function () {
            return FileType::where('status', FileType::STATUS_ENABLE)->get();
        });


        return view('web.file_type', ['data' => $data]);
    }

    public function agreement()
    {
        return view('web.agreement');
    }

    public function newsList(Request $request)
    {
        $data = \Cache::store('file')->remember(('news_list_page' . $request->input('page')), 30, function () {
            return News::where('status', News::STATUS_ENABLED)->paginate(10);
        });

        return view('web.news_list', ['data' => $data]);
    }

    public function news($id)
    {
        $data = \Cache::store('file')->remember(('news' . $id), 60, function () use ($id) {
            return News::findOrFail($id);
        });

        return view('web.news', ['data' => $data]);
    }

    public function contactUs()
    {
        return view('web.contact_us');
    }

    public function contactUsPost(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'name'    => 'nullable|string|regex:/^[\x{4e00}-\x{9fa5}]{2,20}$/u',
                'email'   => 'nullable|email|max:64',
                'phone'   => 'nullable|regex:/^1[34578][0-9]{9}$/',
                'wechat'  => 'nullable|regex:/^[0-9a-zA-Z_]{5,20}$/',
                'content' => 'required|string|min:10',
            ]
        )->validate();

        $result = ContactUs::create($request->only(['name', 'email', 'phone', 'wechat', 'content']));

        if (!$result) {
            return $this->responseError('提交失败，系统内部错误，请联系客服');
        }

        return $this->responseSuccess('恭喜您，提交成功，若您已提供联系方式，稍后我们的客服将会和您取得联系，感谢您关注');
    }
}
