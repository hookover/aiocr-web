@extends('layouts.web')

@section('content')
    <div class="wrapper">
        <div class="page-header page-header-xsmall" style="background-image: url('https://img.alicdn.com/imgextra/i2/63187170/TB2qmF_bnnI8KJjy0FfXXcdoVXa-63187170.jpg')">
            <div class="filter"></div>
            <div class="content-center">
                <div class="motto hidden-xs">
                    <h1 class="text-center">领先的视觉文字识别平台</h1>
                    <h3 class="text-center">视频内容 / 文件文字 / 图片识别 / 图片标记 / 验证码打标分类</h3>
                    <h3 class="text-center">语音人工打标 / 深学人工打标 ...</h3>
                </div>
                <div class="motto hidden-sm hidden-md hidden-lg">
                    <h4 class="text-center">领先的视觉文字识别平台</h4>
                    <h6 class="text-center">视频内容 / 文件文字 / 图片识别 / 图片标记 / 验证码打标分类</h6>
                    <h6 class="text-center">语音人工打标 / 深学人工打标 ...</h6>
                </div>
            </div>
        </div>

        <div class="features-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">高并发,极速的图片识别,样本分类服务</h2>
                        <h5 class="description">
                            全新的识别体验，人工智能+人力模式，99%图片0秒识别.
                        </h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-palette"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">开发者分成</h4>
                                <p class="description">自定义扣费+50%分成，这里就是您自己开的设平台，您只需关注软件业务逻辑，其它就交给我们吧</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-bulb-63"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">全网极低的价格</h4>
                                <p>还在用1块钱100张图片的识别服务？1块钱500张图片的要不要来一打 ：）</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-chart-bar-32"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">强悍的处理引擎</h4>
                                <p>24片Tesla GPU阵列，256G内存和10片E7CPU组成的最强计算核心，实现每秒并发30000+文件，单日可达200+亿的文件的处理能力</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="nc-icon nc-sun-fog-29"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">精确度高</h4>
                                <p>全网图片95.68+%正确率.95.56%图片可以实现自动识别，平均识别时间在0.958秒以内</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="projects-3" id="projects-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <div class="space-top"></div>
                        <h2 class="title">人工标记服务应用场景</h2>
                        <h6 class="category">超过数百万兼职人员，低成本的为深学公司提供定制化的样本分类、样本打标的服务。降低样本分析的时间成本和人力成本。</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-profile card-plain">
                            <div class="card-img-top">
                                <a>
                                    <img class="img" src="https://img.alicdn.com/imgextra/i1/63187170/TB2XsN_bcjI8KJjSsppXXXbyVXa-63187170.jpg">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category">电影视频</h6>
                                <h4 class="card-title">视频内容分类、打标</h4>
                                <p class="card-description">
                                    根据客户要求，提供视频内物体、人物、事件、文字、声音等的标记和分类
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 ">
                        <div class="card card-profile card-plain">
                            <div class="card-img-top">
                                <a>
                                    <img class="img" src="https://img.alicdn.com/imgextra/i3/63187170/TB2Zpd8bhTI8KJjSspiXXbM4FXa-63187170.jpg">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category">图片</h6>
                                <h4 class="card-title">图片内容分类、打标</h4>
                                <p class="card-description">
                                    根据客户要求，提供图片内物体、人物、事件、风格、文字等的标记和分类
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-profile card-plain">
                            <div class="card-img-top">
                                <a>
                                    <img class="img" src="https://img.alicdn.com/imgextra/i1/63187170/TB24q4.blTH8KJjy0FiXXcRsXXa-63187170.jpg">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category">音频</h6>
                                <h4 class="card-title">音频内容分类、打标</h4>
                                <p class="card-description">
                                    根据客户要求，提供音频内事件、内容、风格的标记和分类.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="features-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="container">
                                <h2 class="title">平台支持及将要支持的功能</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info info-horizontal">
                                    <div class="icon icon-success">
                                        <i class="nc-icon nc-layout-11"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">自发卡系统</h4>
                                        <p>为开发者及经销商提供完整的充值卡系统，并且支持大额充值优惠，以帮助大家获得销售利润.</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-warning">
                                        <i class="nc-icon nc-palette"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">积分随时锁定</h4>
                                        <p>随时锁定，按需锁定.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info info-horizontal">
                                    <div class="icon icon-danger">
                                        <i class="nc-icon nc-touch-id"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">安全</h4>
                                        <p>HSA256加密认证，SSL加密传输，API自定义最长30天通信KEY自动过期，随时自由停用以前的通信KEY.</p>
                                    </div>
                                </div>
                                <div class="info info-horizontal">
                                    <div class="icon icon-primary">
                                        <i class="nc-icon nc-delivery-fast"></i>
                                    </div>
                                    <div class="description">
                                        <h4 class="info-title">异地使用邮件提醒</h4>
                                        <p>免费的安全提醒服务，可配置异地使用限制</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5 ml-auto">
                        <div class="wali-container">
                            <img src="https://img.alicdn.com/imgextra/i4/63187170/TB2aHR9bcbI8KJjy1zdXXbe1VXa-63187170.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection