@extends('layouts.web_sub_page')

@section('content')
    
    {{--<div class="page-header page-header-xsmall" style="background-image: url('https://img.alicdn.com/imgextra/i2/63187170/TB2Uvwnbf6H8KJjy0FjXXaXepXa-63187170.jpg')">--}}
        {{--<div class="filter"></div>--}}
        {{--<div class="content-center">--}}
            {{--<div class="motto">--}}
                {{--<h1 class="text-center">与我们联系</h1>--}}
                {{--<h3 class="text-center">您有任何需求和建议,请随时与我们取得联系,</h3>--}}
                {{--<h3 class="text-center">我们会认真采纳您的意见做出相应的改进</h3>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="main">
        <div class="section section-gray">
            <div class="container" style="padding-top:75px;">
                {{--<div class="row">--}}
                    {{--<div class="col-md-12 ml-auto mr-auto text-center">--}}
                        {{--<h2 class="title">与我们联系</h2>--}}
                        {{--<p>您有任何需求和建议,请随时与我们取得联系,</p>--}}
                        {{--<p>我们会认真采纳您的意见做出相应的改进</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <div class="card card-contact no-transition">
                            <h3 class="card-title text-center">联系我们</h3>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="card-body">
                                        <div class="info info-horizontal">
                                            <div class="icon icon-info">
                                                <i class="nc-icon nc-pin-3" aria-hidden="true"></i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">我们的地址</h4>
                                                <p> {{ env('SERVER_ADDRESS') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="info info-horizontal">
                                            <div class="icon icon-danger">
                                                <i class="nc-icon nc-headphones" aria-hidden="true"></i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">客服电话</h4>
                                                   <p> {{ env('SERVER_TELETE') }}<br>
                                                    服务时间 9:00-18:00
                                                   </p>
                                            </div>
                                        </div>
                                        <div class="info info-horizontal">
                                            <div class="icon icon-danger">
                                                <i class="nc-icon nc-email-85" aria-hidden="true"></i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">客服QQ</h4>
                                               <p> {{ env('SERVER_QQ') }}<br>
                                                服务时间 9:00-18:00
                                               </p>
                                            </div>
                                        </div>
                                        <div class="info info-horizontal">
                                            <div class="icon icon-danger">
                                                <i class="nc-icon nc-badge" aria-hidden="true"></i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">客服微信</h4>
                                                <p>
                                                    <img style="width:100px;" src="/web/assets/img/wechat.png" alt="微信客服">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 mr-auto">
                                    <div role="form" id="contact-form">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">姓名</label>
                                                        <input name="name" id="name" class="form-control" placeholder="您的姓名" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">邮箱</label>
                                                        <input name="name" id="email" class="form-control" placeholder="您的邮箱" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">电话</label>
                                                        <input name="name" id="phone" class="form-control" placeholder="您的电话" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">微信</label>
                                                        <input name="name" id="wechat" class="form-control" placeholder="您的微信" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label class="control-label">内容</label>
                                                <textarea name="message" id="content" class="form-control" rows="23" placeholder="请输入内容,10个字符以上"></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                </div>
                                                <div class="col-md-6">
                                                    <button id="button-contact" class="btn btn-primary pull-right">提交</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="/web/assets/js/notifier/pnotify.custom.min.css">
@endsection

@section('js')
    <script src="/web/assets/js/notifier/pnotify.custom.min.js"></script>
    <script>
        $(function () {
            $('#button-contact').click(function () {
                if($('#content').val() == ''){
                    new PNotify({
                        title: '错误',
                        text: '内容不能为空',
                        type: 'error'
                    });
                    $('#content').focus();
                    return false;
                }
                var postData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    wechat: $('#wechat').val(),
                    content: $('#content').val(),
                    "_token": $('meta[name="csrf-token"]').attr('content')
                }

                $.ajax({
                    url: '/contact-us',
                    type: 'post',
                    data: postData,
                    dataType: 'json',
                    success: function (response) {
                        if(response.status_code === 200){
                            new PNotify({
                                title: '成功',
                                addclass: "stack-modal",
                                text: response.message,
                                type: 'success'
                            });
                            $('#name').val('');
                            $('#email').val('');
                            $('#phone').val('');
                            $('#wechat').val('');
                            $('#content').val('');
                        }else{
                            new PNotify({
                                title: '错误',
                                text: response.message,
                                type: 'error'
                            });
                        }
                    },
                    error: function (a,b,c) {
                        if(a.hasOwnProperty('responseJSON')) {
                            if(a.responseJSON.hasOwnProperty('errors')) {
                                $.each(a.responseJSON.errors, function (index, data) {
                                    new PNotify({
                                        title: '错误',
                                        text: data[0],
                                        type: 'error'
                                    })
                                })

                            } else {
                                if(a.responseJSON.hasOwnProperty('message')) {
                                    new PNotify({
                                        title: '错误',
                                        text: a.responseJSON.message,
                                        type: 'error'
                                    })
                                } else {
                                    new PNotify({
                                        title: '错误',
                                        text: '网络错误，请稍后再试！',
                                        type: 'error'
                                    })
                                }
                            }
                        } else {
                            new PNotify({
                                title: '错误',
                                addclass: "stack-modal",
                                text: '网络错误，请稍后再试！',
                                type: 'error'
                            })
                        }
                    }
                })
            })
        })
    </script>
@endsection