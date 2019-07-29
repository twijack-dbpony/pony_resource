<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>通用</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-mortar-board"></i> 服务器信息 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('w_psd')}}">列表展示</a></li>
                    <li><a href="{{route('w_pso')}}">添加</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-bank"></i> db日常账单信息 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('d_psd')}}">列表展示</a></li>
                    <li><a href="{{route('d_pbc')}}">图表展示</a></li>
                    <li><a href="{{route('d_pso')}}">添加</a></li>
                </ul>
            </li>
            {{--<li><a><i class="fa fa-expand"></i> 专转本题库 <span class="fa fa-chevron-down"></span></a>--}}
                {{--<ul class="nav child_menu">--}}
                    {{--<li><a href="{{route('q_pq')}}">测试</a></li>--}}
                    {{--<li><a href="{{route('q_psd')}}">列表展示</a></li>--}}
                    {{--<li><a href="{{route('q_pso')}}">添加</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li><a><i class="fa fa-gamepad"></i> 游戏小马 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('gp_d')}}">列表</a></li>
                    <li><a href="{{route('gp_dd')}}">dota小马</a></li>
                    <li><a href="{{route('gp_op')}}">添加</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-photo"></i> 小马图库 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('gap_d')}}">列表</a></li>
                    <li><a href="{{route('gap_op')}}">添加</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-money"></i> 众筹 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('pc_d')}}">第一次众筹列表</a></li>
                    <li><a href="{{route('pc_d').'?type=2'}}">第二次众筹列表</a></li>
                    <li><a href="{{route('pc_re')}}">众筹地域统计</a></li>
                    <li><a href="{{route('pc_l')}}">众筹档次统计</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-home"></i> 帐号相关 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('celestia_set')}}">个人设置</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-plug"></i> 成员管理 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('celestia_pl')}}">成员列表</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-legal"></i> 管理员管理 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('celestia_rl')}}">管理员列表</a></li>
                    <li><a href="{{route('celestia_ra')}}">新增管理员</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-newspaper-o"></i> 文章管理 <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('celestia_ppl')}}">文章列表</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->