<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$appName}}登录</title>

    <!-- CSS -->
    {{--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">--}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/form-elements.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{asset('images/PearButter.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/144x144.jpg')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/114x114.jpg')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/72x72.jpg')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/57x57.jpg')}}">

</head>

<body>

<!-- Top menu -->
<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="top-navbar-1">
            <ul class="nav navbar-nav navbar-right">
                <li>

                    <span class="li-social">
								<a href="#"><i class="fa fa-tag"></i></a>
								<a href="#"><i class="fa fa-file"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>
								<a href="{{route('manesix_r')}}"><i class="fa fa-key"></i></a>
							</span>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger" style="background-color: orangered;color: whitesmoke;opacity: 0.8">
                        <ul style="list-style: none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif(session('postscript'))
                    <div class="alert alert-danger" style="background-color: limegreen;color: whitesmoke;opacity: 0.8">
                        <ul style="list-style: none">
                            <li>{{ session('postscript') }}</li>
                        </ul>
                    </div>
                @endif
                <div class="col-sm-8 col-sm-offset-2 text">
                    <h1><strong>{{$appName}}</strong></h1>
                    <div class="description">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 book">
                    <img src="{{asset('images/mlp_the_movie.jpg')}}" style="border-radius: 20px;width:60%;height:30%" alt="MLPFIM" title="My Little Pony The Movie">
                </div>
                <div class="col-sm-5 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>登录{{$appName}}！</h3>
                            <p>输入你的用户名和密码</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form id="luna_form" action="{{route('manesix_pl')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="sr-only" for="form-first-name">用户名</label>
                                <input type="text" name="ponyname" placeholder="用户名..." class="form-control" id="ponyname" value="{{old('ponyname')}}">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-last-name">密码</label>
                                <input type="password" name="password" placeholder="密码..." class="form-control" id="password" value="{{old('password')}}">
                            </div>
                            <div class="form-group">
                                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码" style="margin: 0 auto;margin-bottom: 15px;width:100%;height:60px">
                                <label class="sr-only" for="form-email">验证码</label>
                                <input type="text" name="captcha" id="captcha" placeholder="验证码..." class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn">登录！</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('layer-v3.1.1/layer.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.backstretch.min.js')}}"></script>
{{--<script src="{{asset('/assets/js/retina-1.1.0.min.js')}}"></script>--}}
<script src="{{asset('js/scripts.js')}}"></script>
</body>
</html>