@extends('structure.equestria_front')
@section('title','个人信息')
@section('body')
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
            <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">{{$pony['nickname']}}的个人资料</h1>
                            <p>要做什么改动吗？</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#action-->

    <section id="portfolio-information" class="padding-top">
        <div class="container">
            @if (session('postscript'))
                <div class="alert alert-danger" style="background-color: limegreen;color: whitesmoke">
                    <ul>
                        <li>{{ session('postscript') }}</li>
                    </ul>
                </div>
            @endif
            <div class="row">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-sm-2">
                        <h2 class="bold" style="margin-left: 40px">用户头像</h2>

                        <img src="{{asset($pony['avatar'])}}" style="border-radius: 50%;" class="img-responsive" alt="">

                    </div>
                    <div class="col-sm-10">
                        <div class="project-name overflow">
                            <h2 class="bold">{{$pony['nickname']}} </h2>
                            <ul class="nav navbar-nav navbar-default">
                                <li><a href="#">注册时间：<i class="fa fa-clock-o"></i>{{$pony['created_time']}}</a></li>
                            </ul>
                        </div>
                        <div class="project-info overflow">
                            <h3>昵称:</h3>

                            <p style="color: #cb555a">{{$pony['nickname']}}</p>

                            <h3>用户名:</h3>
                            <p style="color: #cb555a">{{$pony['ponyname']}}</p>
                        </div>
                        <div class="project-info overflow">
                            <h3>个人简介:</h3>

                            <p style="color: #cb555a">{{$pony['intro']}}</p>

                        </div>
                        <div class="skills overflow">
                            <h3>在本站的活动</h3>
                            <ul class="nav navbar-nav navbar-default">
                                <li><a href="javascript:;"><i class="fa fa-file"></i>文章发表：{{$pony['ponypost'] ? : 0}}
                                    </a></li>
                                <li><a href="javascript:;"><i class="fa fa-comment"></i>评论发表：{{$comment ? : 0}}</a></li>
                                <li><a href="javascript:;"><i class="fa fa-heart"></i>喜欢文章：{{$pony['fav']}}
                                    </a></li>
                            </ul>
                        </div>
                        <div class="live-preview">

                            <a href="{{route('manesix_pie')}}" class="btn btn-common uppercase">编辑</a>
                            <a href="{{url('ponypost_list').'?sort=your&type=all'}}" class="btn btn-common uppercase">我的文章</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection