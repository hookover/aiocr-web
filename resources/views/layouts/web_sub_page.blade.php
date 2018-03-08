@extends('layouts.web')

@section('nav')

    <nav class="navbar navbar-expand-lg fixed-top bg-info nav-down">
        <div class="container">
            <div class="navbar-translate">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">机器识别 | jiqishibie.com</a>
                </div>
                <button class="navbar-toggler navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
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

@stop