@include('structure.front.equestria_header')
<body @tbi() onload="instantiateTextbox();" @endtbi>
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 overflow">
                <div class="social-icons pull-right">
                    <ul class="nav nav-pills">
                        @if(!session('ponyid'))
                            <li><a style="color: darkgray" href="{{route('manesix_l')}}">登录</a></li>
                            <li><a style="color: darkgray" href="{{route('manesix_r')}}">注册</a></li>
                        @else
                            <li><a href="">
                                    <img src="{{asset(session('avatar'))}}" alt="{{session('nickname')}}" style="width: 50px;border-radius: 50px" title="{{session('nickname')}}"/>
                                </a>
                            </li>
                            <li style="margin-top: 14px">
                                <a href="">
                                    <span style="font-weight: bold;font-size: 15px;color:#00aeef"></span>
                                </a>
                                <a href="{{route('manesix_lo')}}">
                                    <span class="btn btn-link pony_logout">登出</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-inverse" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{route('manesix_self')}}">
                    <h1 style="vertical-align: middle"><img src="{{asset('images/PearButter.png')}}" width="40px" height="40px" style="border-radius: 30px"><strong>{{$appName}}</strong></h1>
                </a>

            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @foreach($sidebar as $side)
                        @if($side[2] == 'login')
                            @if(!session('ponyid'))
                                @continue
                            @endif
                        @endif
                        <li @if(url()->current() == route($side[0]))
                                class="active"
                            @endif>
                            <a href="{{route($side[0])}}">{{$side[1]}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="search">
                <form role="form" action="{{route('manesix_ppl')}}" method="post">
                    {{csrf_field()}}
                    <i class="fa fa-search"></i>
                    <div class="field-toggle">
                        <input type="text" class="search-form" autocomplete="off" placeholder="搜索文章" name="search_global" value="{{@$keyword}}">
                        <button class="btn btn-info" type="submit" style="margin-bottom: 10px">搜索</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
<!--/#header-->
@yield('body')
@include('structure.front.equestria_footer')
</body>
</html>