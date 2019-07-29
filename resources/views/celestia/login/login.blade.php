<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$appName}}后台登录</title>

    <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('images/PearButter.png')}}">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            @if ($errors->any())
                <div class="alert alert-danger" style="background-color: orangered;color: whitesmoke">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <section class="login_content">
                <form id="db_login" action="{{route('celestia_bpl')}}" method="post">
                    {{csrf_field()}}
                    <h1>{{$appName}}后台登录</h1>
                    <div>
                        <span style="color: red;float: left" id="error"></span>
                    </div>
                    <div>
                        <input type="text" class="form-control" id="royalwatcher" name="royalwatcher" placeholder="你是谁" value="{{old('royalwatcher')}}"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" id="password" name="password" placeholder="知道暗号吗" value="{{old('password')}}"/>
                    </div>
                    <div>
                        <img style="width: 100%;height: 55px" class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                        <input type="text" class="form-control" id="captcha" name="captcha" placeholder="验证码" />
                    </div>
                    <div>
                        <button class="btn btn-default submit btn-login">登录</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-life-saver"></i> {{$appName}}后台</h1>
                            <p>©2018 All Rights Reserved.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>

<script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
