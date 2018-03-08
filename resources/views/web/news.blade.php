@extends('layouts.web_sub_page')

@section('title')
    <title>机器识别-新闻公告,{{ $data->title }}</title>
@endsection

@section('keywords')
    <meta name="keywords" content="{{ $data->keywords}}">
@endsection

@section('description')
    <meta name="description" content="{{ $data->description }}">
@endsection

@section('content')
    {{--<div class="page-header page-header-xsmall" style="background-image: url('https://img.alicdn.com/imgextra/i3/63187170/TB2vIV9blDH8KJjSspnXXbNAVXa-63187170.jpg')">--}}
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
                <div class="container" style="min-height:600px;">
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto text-center title">
                            <h3>{{ $data->title }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ml-auto mr-auto">
                            <div class="article-content">
                                <p>{!! $data->content !!}</p>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection