<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>充值成功</title>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 60px;
        }

        .tips {
            color: #636b6f;
            padding: 0 25px;
            font-size: 25px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            恭喜您，充值成功！
        </div>
        <div class="tips">
            将在<span id="second">5</span>秒后跳转
        </div>
    </div>
</div>
<script>
    var second   = 5;
    var interval = setInterval(function () {
        second                                      = second - 1;
        document.getElementById('second').innerHTML = second;
        console.log(second)
        if (second <= 0) {
            window.location.href= '{{ $data->user_type == \App\Models\Payment::TYPE_ACCOUNT_USER ? route('payment-user') : route('payment-developer') }}';
        }
    }, 1000)
</script>
</body>
</html>
