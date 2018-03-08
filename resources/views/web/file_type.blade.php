@extends('layouts.web_sub_page')
@section('title')
    <title>机器识别-人工标签分类服务,专业的验证码云端识别服务,专业的机器识别，让验证码识别更快速、更准确、更强大</title>
@endsection

@section('content')
    {{--<div class="page-header page-header-xsmall" style="background-image: url('https://img.alicdn.com/imgextra/i2/63187170/TB2JZ9Xbh6I8KJjy0FgXXXXzVXa-63187170.jpg')">--}}
        {{--<div class="filter"></div>--}}
        {{--<div class="content-center">--}}
            {{--<div class="motto">--}}
                {{--<h1 class="text-center">领先的视觉文字识别平台</h1>--}}
                {{--<h3 class="text-center">价格全网最低 / 全程采用机器识别 / 识别速度更快 / 更准 / 效率更高</h3>--}}
                {{--<h3 class="text-center">语音人工打标 / 深学人工打标 ...</h3>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="section section-gray">--}}
    <div class="wrapper" style="min-height:700px;">
        <div class="main">
            <div class="section section-white">
                <div class="container tim-container">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto title">
                    <h3>类型ID定义</h3>
                    <p>理论上我们可以识别任何类型图片，若表里没有，请联系我们的技术为您定制添加！</p>
                    <p class="text-info">积分汇率：￥1 = {{ env('MONEY_TO_POINT_PAY', '未配置') }}积分</p>
                </div>
                        <div class="col-md-12 ml-auto mr-auto">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>长度(0为不限制)</th>
                                <th>名称</th>
                                <th>描述</th>
                                <th>单次扣分</th>
                                {{--<th class="text-right">Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $value)
                                <tr>
                                    <td>{{ $value->file_type_id }}</td>
                                    <td>{{ $value->length }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>{{ $value->cost }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection