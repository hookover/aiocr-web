@extends('layouts.web_sub_page')

@section('title')
    <title>机器识别-新闻公告,获取最新的行业动态,专业的验证码云端识别服务,专业的机器识别，让验证码识别更快速、更准确、更强大</title>
@endsection

@section('content')
    <style>
        .pagination li{
            float:left;
        }
        div nav .pagination{
            position: relative;
            display:inline-block
        }
    </style>
    {{--<div class="page-header page-header-xsmall" style="background-image: url('https://img.alicdn.com/imgextra/i3/63187170/TB2tFF3bmYH8KJjSspdXXcRgVXa-63187170.jpg')">--}}
        {{--<div class="filter"></div>--}}
        {{--<div class="content-center">--}}
            {{--<div class="motto">--}}
                {{--<h1 class="text-center">领先的视觉文字识别平台</h1>--}}
                {{--<h3 class="text-center">新闻咨询 / 最新公告 / 获取行业内最新动态 / 人工智能 / 让你走在最前沿</h3>--}}
                {{--<h3 class="text-center">语音人工打标 / 深学人工打标 ...</h3>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="wrapper">
        <div class="main">
            <div class="section section-white">
                <div class="container" style="padding-top:50px;min-height:700px;">
                    @foreach($data as $new)
                    <div class="article">
                        <div class="row">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="card card-blog card-plain text-center">
                                    <div class="card-body">
                                        <a href="/news/{{ $new->id }}">
                                            <h3 class="card-title">{{ $new->title }}</h3>
                                        </a>
                                        <div class="card-description">
                                            {{ str_limit($new->description, 100, '...') }}
                                        </div>
                                    </div>
                                    <a href="/news/{{ $new->id }}" class="btn btn-danger btn-round btn-sm">阅读详情</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <hr>
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto text-center">
                            <nav aria-label="Page navigation example">
                                {{ $data->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection