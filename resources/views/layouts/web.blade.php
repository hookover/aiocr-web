<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    @section('title')
        <title>机器识别-专业的验证码云端识别服务,专业的机器识别，让验证码识别更快速、更准确、更强大</title>
    @show


    <!--  Social tags      -->
    @section('keywords')
        <meta name="keywords" content="超级快,超级准确证码识别,验证码识别,识别验证码,机器识别证码识别平台">
    @show

    @section('description')
        <meta name="description" content="机器识别验证码识别,是识别验证码里的超级机器人，可为您提供专业的验证码云端识别服务,让验证码识别更快速、更准确、更强大。可为所有软件提供验证码识别自动化解决方案,帮助客户进行验证码识别、远程答题、机器打码,为用户实现价值">
    @show

    <!--  end meta tags-->

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    {{--<link href="/web/assets/css/bootstrap.min.css" rel="stylesheet"/>--}}
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <link href="/web/assets/css/paper-kit.css?v=2.1.0" rel="stylesheet"/>
    <link href="/web/assets/css/demo.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    {{--<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>--}}
    {{--<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="/web/assets/css/googleapis.css">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/web/assets/css/nucleo-icons.css" rel="stylesheet">
    @yield('css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
@section('nav')
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent bg-info nav-down" color-on-scroll="300">
    <div class="container">
        <div class="navbar-translate">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">机器识别 | jiqishibie.com</a>
            </div>
            <button class="navbar-toggler navbar-burger" type="button" data-toggle="collapse"
                    data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="/apidoc" data-scroll="true" href="javascript:void(0)">API文档</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/file-type" data-scroll="true" href="javascript:void(0)">文件类型价目表</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown">平台相关</a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-danger">
                        <a class="dropdown-item" href="/news-list"><i class="nc-icon nc-tile-56"></i>&nbsp;新闻公告</a>
                        <a class="dropdown-item" href="/agreement"><i class="nc-icon nc-bookmark-2"></i>&nbsp;使用协议</a>
                        <a class="dropdown-item" href="/contact-us"><i class="nc-icon nc-send"></i>&nbsp;联系我们</a>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/login" class="btn btn-info btn-round"><i class="fa fa-lock"></i> 登 &nbsp;&nbsp;&nbsp; 录</a>
                    <a href="/register" class="btn btn-warning btn-round"><i class="fa fa-heart"></i> 注 &nbsp;&nbsp;&nbsp; 册</a>
                </li>



            </ul>
        </div>
    </div>
</nav>
@show

@yield('content')

@section('footer')
<footer class="footer footer-black footer-big">
    <div class="container">
        <div class="row">
            <div class="col-md-2 text-center col-sm-3 col-12 ml-auto mr-auto">
                <h4>机器识别</h4>
                <h5 class="text-white">jiqishibie.com</h5>
                <div class="social-area">
                    <a class="btn btn-just-icon btn-round btn-facebook">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-just-icon btn-round btn-twitter">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-just-icon btn-round btn-google">
                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-12 ml-auto mr-auto">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-6">
                        <div class="links">
                            <ul class="uppercase-links stacked-links">
                                <li>
                                    <a href="/">
                                        首页
                                    </a>
                                </li>
                                <li>
                                    <a href="/contact-us">
                                        联系我们
                                    </a>
                                </li>
                                <li>
                                    <a href="/news-list">
                                        新闻公告
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-6">
                        <div class="links">
                            <ul class="uppercase-links stacked-links">
                                <li>
                                    <a href="/user/dashboard">
                                        <i></i>
                                        用户后台
                                    </a>
                                </li>
                                <li>
                                    <a href="/developer/dashboard">
                                        开发者后台
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-6">
                        <div class="links">
                            <ul class="uppercase-links stacked-links">
                                <li>
                                    <a href="/apidoc">
                                        API文档
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-6">
                        <div class="links">
                            <ul class="stacked-links">
                                <li>
                                    <h4>113723<br> <small>合作伙伴</small></h4>
                                </li>
                                <li>
                                    <h4>6552.25亿词/月<br> <small>一级处理能力</small></h4>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="copyright">
                    <div class="pull-left">
                        © <script>document.write(new Date().getFullYear())</script> jiqishibie.com, made with love
                    </div>
                    <div class="links pull-right">
                        <ul>
                            <li>
                                <a href="/agreement">
                                    许可协议
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
@show
</body>

<!-- Core JS Files -->
{{--<script src="/web/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>--}}
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="/web/assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
{{--<script src="/web/assets/js/popper.js" type="text/javascript"></script>--}}
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.js"></script>
{{--<script src="/web/assets/js/bootstrap.min.js" type="text/javascript"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

<!-- Switches -->
{{--<script src="/web/assets/js/bootstrap-switch.min.js"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>

<!-- Sharrre plugin -->
{{--<script src="/web/assets/js/presentation-page/jquery.sharrre.js"></script>--}}
<script src="https://cdn.bootcss.com/Sharrre/1.3.5/js/jquery.sharrre.js"></script>

<!--  Plugins for Slider -->
{{--<script src="/web/assets/js/nouislider.js"></script>--}}
<script src="https://cdn.bootcss.com/noUiSlider/9.2.0/nouislider.js"></script>

<!--  Photoswipe files -->
{{--<script src="/web/assets/js/photo_swipe/photoswipe.min.js"></script>--}}
<script src="https://cdn.bootcss.com/photoswipe/4.1.0/photoswipe.min.js"></script>
{{--<script src="/web/assets/js/photo_swipe/photoswipe-ui-default.min.js"></script>--}}
<script src="https://cdn.bootcss.com/photoswipe/4.1.0/photoswipe-ui-default.min.js"></script>
<script src="/web/assets/js/photo_swipe/init-gallery.js"></script>

<!--  Plugins for Select -->
{{--<script src="/web/assets/js/bootstrap-select.js"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap-select/1.12.2/js/bootstrap-select.js"></script>

<!--  for fileupload -->
{{--<script src="/web/assets/js/jasny-bootstrap.min.js"></script>--}}
<script src="https://cdn.bootcss.com/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

<!--  Plugins for Tags -->
{{--<script src="/web/assets/js/bootstrap-tagsinput.js"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

<!--  Plugins for DateTimePicker -->
{{--<script src="/web/assets/js/moment.min.js"></script>--}}
<script src="https://cdn.bootcss.com/moment.js/2.18.1/moment.min.js"></script>
{{--<script src="/web/assets/js/bootstrap-datetimepicker.min.js"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script src="/web/assets/js/paper-kit.js?v=2.1.0"></script>

@yield('js')
</html>
