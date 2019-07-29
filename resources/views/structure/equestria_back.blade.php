<!DOCTYPE html>
<html lang="en">
@include('structure.back.equestria_header')
<body class="nav-md" @tbi() onload="instantiateTextbox();" @endtbi>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{route('celestia_self')}}" class="site_title"><i class="fa fa-road"></i> <span>华东小马-后台</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="{{asset('images/diamond-breach.jpg')}}" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>{{config('miscellanea.royal_watcher_rank')[session('role')]}}</span>
                        <h2>{{session('royalwatcher')}}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />
                @include('structure.back.equestria_sidebar')
                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="个人设置" href="{{route('celestia_set')}}">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="登出" href="{{route('celestia_blo')}}">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('/images/diamond-breach.jpg')}}" alt="">{{session('royalwatcher')}}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li>
                                    <a href="">
                                        <span>个人设置</span>
                                    </a>
                                </li>
                                <li><a href="{{route('celestia_blo')}}"><i class="fa fa-sign-out pull-right"></i>登 出</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        @yield('body')
    </div>
</div>
@include('structure.back.equestria_footer')
</body>
</html>
