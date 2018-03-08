

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    {{--<link rel="apple-touch-icon" sizes="76x76" href="/backend/assets/img/apple-icon.png">--}}
    {{--<link rel="icon" type="image/png" sizes="96x96" href="/backend/assets/img/favicon.png">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>{{Auth::user()->user_id ? '用户后台' : (Auth::user()->developer_id ? '开发者后台' : '管理员后台') }}</title>

    <!-- Canonical SEO -->
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--  Social tags      -->
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Bootstrap core CSS     -->
    {{--<link href="/backend/assets/css/bootstrap.min.css" rel="stylesheet" />--}}
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!--  Paper Dashboard core CSS    -->
    <link href="/backend/assets/css/paper-dashboard.css" rel="stylesheet"/>

    <link href="/backend/assets/css/common.css" rel="stylesheet" />

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/backend/assets/css/app.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='/backend/assets/css/Muli.css' rel='stylesheet'>
    <link href="/backend/assets/css/themify-icons.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@inject('menu', 'App\Http\Controllers\BackendMenuController')

<body>
<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="success">
        <!--
            Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
            Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
        -->
        <div class="logo">
            <a href="/" class="simple-text logo-mini">
                AI
            </a>

            <a href="/" class="simple-text logo-normal">
                {{Auth::user()->user_id ? '用户后台' : (Auth::user()->developer_id ? '开发者后台' : '管理员后台')}}
            </a>
        </div>
        <div class="sidebar-wrapper">
            {!! Menu::main() !!}
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">切换菜单</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#settings" class="dropdown-toggle btn-rotate" data-toggle="dropdown" data-hover="dropdown">
                                <i class="ti-settings"></i>
                                <span class="notification">设置</span>
                                <p class="hidden-md hidden-lg">
                                    Settings
                                </p>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        退出
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ Auth::user()->admin_id ? route('logout-out-admin') : route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">

                @include('layouts.backend_alert')

                @yield('content')


            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            客服QQ：8888888
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by jiqishibie.com
                </div>
            </div>
        </footer>
    </div>
</div>

</body>

<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
{{--<script src="/backend/assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>--}}
<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
{{--<script src="/backend/assets/js/jquery-ui.min.js" type="text/javascript"></script>--}}
<script src="https://cdn.bootcss.com/jqueryui/1.11.4/jquery-ui.min.js"></script>
{{--<script src="/backend/assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>--}}
<script src="https://cdn.bootcss.com/jquery.perfect-scrollbar/0.6.10/js/min/perfect-scrollbar.min.js"></script>
{{--<script src="/backend/assets/js/bootstrap.min.js" type="text/javascript"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--  Forms Validations Plugin -->
{{--<script src="/backend/assets/js/jquery.validate.min.js"></script>--}}
<script src="https://cdn.bootcss.com/jquery-validate/1.14.0/jquery.validate.min.js"></script>

<!-- Sliders Plugin -->
{{--<script src="/backend/assets/js/nouislider.min.js"></script>--}}
<script src="https://cdn.bootcss.com/noUiSlider/9.1.0/nouislider.min.js"></script>

<!-- Promise Library for SweetAlert2 working on IE -->
<script src="/backend/assets/js/es6-promise-auto.min.js"></script>

<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="/backend/assets/js/moment.min.js"></script>

<!--  Date Time Picker Plugin is included in this js file -->
<script src="/backend/assets/js/bootstrap-datetimepicker.js"></script>

<!--  Select Picker Plugin -->
<script src="/backend/assets/js/bootstrap-selectpicker.js"></script>

<!--  Switch and Tags Input Plugins -->
{{--<script src="/backend/assets/js/bootstrap-switch-tags.js"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap-switch/3.3.2/js/bootstrap-switch.js"></script>

<!-- Circle Percentage-chart -->
<script src="/backend/assets/js/jquery.easypiechart.min.js"></script>

<!--  Charts Plugin -->
{{--<script src="/backend/assets/js/chartist.min.js"></script>--}}
<script src="https://cdn.bootcss.com/chartist/0.9.7/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="/backend/assets/js/bootstrap-notify.js"></script>

<!-- Sweet Alert 2 plugin -->
{{--<script src="/backend/assets/js/sweetalert2.js"></script>--}}
<script src="https://cdn.bootcss.com/limonte-sweetalert2/6.2.9/sweetalert2.js"></script>

<!-- Vector Map plugin -->
{{--<script src="/backend/assets/js/jquery-jvectormap.js"></script>--}}
<script src="https://cdn.bootcss.com/jvectormap/2.0.4/jquery-jvectormap.js"></script>

<!-- Wizard Plugin    -->
<script src="/backend/assets/js/jquery.bootstrap.wizard.min.js"></script>

<!--  Bootstrap Table Plugin    -->
{{--<script src="/backend/assets/js/bootstrap-table.js"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap-table/1.8.1/bootstrap-table.js"></script>

<!--  Plugin for DataTables.net  -->
{{--<script src="/backend/assets/js/jquery.datatables.js"></script>--}}
<script src="https://cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.js"></script>

<!--  Full Calendar Plugin    -->
{{--<script src="/backend/assets/js/fullcalendar.min.js"></script>--}}
<script src="https://cdn.bootcss.com/fullcalendar/3.1.0/fullcalendar.min.js"></script>

<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
<script src="/backend/assets/js/paper-dashboard.js?v=1.2.1"></script>

<!--   Sharrre Library    -->
{{--<script src="/backend/assets/js/jquery.sharrre.js"></script>--}}
<script src="https://cdn.bootcss.com/Sharrre/1.3.5/js/jquery.sharrre.js"></script>

<!-- 引入 ECharts 文件 -->
<script src="https://cdn.bootcss.com/echarts/3.7.2/echarts.min.js"></script>

<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
<script src="/backend/assets/js/app.js"></script>

@if(Auth::user()->admin_id)
<script src="/backend/assets/js/admin-only.js"></script>
@endif


@yield('script')

</html>
