@extends('structure.equestria_front')
@section('title','小马漫画')
@section('body')
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
            <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">小马漫画</h1>
                            <p>这不是一个图书馆</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#page-breadcrumb-->

    <section id="blog" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="single-blog single-column">
                                <div class="post-thumb">
                                    <object height="800" data="{{asset('Transcend/'.$comic->location)}}" type="application/pdf" width="900"></object>
                                </div>
                                {{--<div class="post-content overflow">--}}
                                    {{--<h2 class="post-title bold"><a style="font-size: 28px" href="#">{{$episode->name}}</a><sub style="font-size: 10px;color: black;padding-left:10px;opacity: 0.5">发表时间:{{$episode->created_at}}</sub></h2>--}}
                                    {{--<div style="clear: both"></div>--}}
                                    {{--<p style="font-size: 18px;margin-top: 10px;color: #0099AE">内容简介：</p>--}}
                                    {{--<p style="font-size: 16px;margin-top: 10px;">{{$episode->desc}}</p>--}}
                                    {{--<div class="post-bottom overflow">--}}
                                        {{--<ul class="nav navbar-nav post-nav">--}}
                                            {{--<li>--}}
                                                {{--<a href="javascript:;" onclick="">--}}
                                                    {{--<i class="fa fa-comments"></i>--}}
                                                    {{--弹幕 <span class="comment_total"></span> 个--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<a href="">--}}
                                                    {{--<i class="fa fa-hand-pointer-o"></i>--}}
                                                    {{--浏览 <span class="click_total">{{$episode->click}}</span> 次--}}
                                                {{--</a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<p style="font-size: 16px;margin-top: 10px;text-indent: 40px"></p>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        <div class="sidebar-item categories">
                            <h3>Seasons</h3>
                            <ul class="nav navbar-stacked">

                            </ul>
                        </div>
                        <div class="sidebar-item popular">
                            <h3>Latest Photos</h3>
                            <ul class="gallery">
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                                <li><a href="#"><img src="{{asset('images/brony.jpg')}}" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
