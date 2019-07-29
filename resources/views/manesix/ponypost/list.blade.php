@extends('structure.equestria_front')
@section('title','文章列表')
@section('body')
<section id="page-breadcrumb">
    <div class="vertical-center sun">
        <div class="container">
            <div class="row">
                <div class="action">
                    <div class="col-sm-12">
                        <h1 class="title">文章列表页</h1>
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
                @if(session('postscript'))
                    <div class="alert alert-danger" style="background-color: limegreen;color: whitesmoke">
                        <ul>
                            <li>{{ session('postscript') }}</li>
                        </ul>
                    </div>
                @endif
                <div class="row">
                    @foreach($ponypost as $pp)
                        <div class="col-sm-12 col-md-12">
                            <div class="single-blog single-column">
                                <div class="post-thumb">
                                    @if(in_array($pp->postid,$fav))
                                        <input type="hidden" id="fav_{{$pp->postid}}" value="unfav">
                                    @else
                                        <input type="hidden" id="fav_{{$pp->postid}}" value="fav">
                                    @endif
                                    <a href="{{url('manesix_ponypost_self/postid/'.$pp->postid)}}"><img src="{{$pp->water_img}}" class="img-responsive" alt=""></a>
                                    <div class="post-overlay">
                                        @php
                                            $pp_date = date('m-d',strtotime($pp->created_time));
                                            $pp_date = explode('-',$pp_date);
                                        @endphp
                                        <span class="uppercase"><a href="javascript:;"> {{$pp_date[1]}}<br><small>{{config('miscellanea.mandarin_month')[$pp_date[0]]}}</small></a></span>
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><a style="font-size: 28px" href="{{url('manesix_ponypost_self/postid/'.$pp->postid)}}">{{$pp->title}}</a><sub style="font-size: 10px;color: black;padding-left:10px;opacity: 0.5">发表时间:{{$pp->created_time}}</sub></h2>
                                    <div>
                                        <img src="{{$pp->avatar}}" class="img-responsive" style="float: left;border-radius: 50px" alt="" width="50px">
                                        <h3 class="post-author" style="float: left;line-height: 50px;margin-left: 15px"><a href="#">作者：{{$pp->nickname}}</a></h3>
                                    </div>
                                    <div style="clear: both"></div>
                                    <p style="font-size: 18px;margin-top: 10px;color: #0099AE">内容简介：</p>
                                    <p style="font-size: 16px;margin-top: 10px;text-indent: 40px">{{$pp->description}}</p>
                                    <div class="post-bottom overflow">
                                        <ul class="nav navbar-nav post-nav">
                                            <li><a href="javascript:;"><i class="fa {{config('miscellanea.ponypost_type')[$pp->type]['tag']}}"></i>{{config('miscellanea.ponypost_type')[$pp->type]['char']}}</a></li>
                                            <li>
                                                <a href="javascript:;" onclick="luna_fav('{{$pp->postid}}')">
                                                    <i class="fa fa-heart"></i>
                                                    @if(!session('ponyid'))
                                                        <span id="fav_info_{{$pp->postid}}" style="font-family: sans-serif">{{$pp->fav ? : 0}} 人喜欢</span>
                                                    @else
                                                        @if(in_array($pp->postid,$fav))
                                                            <span id="fav_info_{{$pp->postid}}" style="font-family: sans-serif">{{$pp->fav}} 人喜欢(已喜欢)</span>
                                                        @else
                                                            <span id="fav_info_{{$pp->postid}}" style="font-family: sans-serif">{{$pp->fav ? : 0}} 人喜欢</span>
                                                        @endif
                                                    @endif
                                                </a>
                                            </li>
                                            <li><a href="javascript:;"><i class="fa fa-comments"></i>
                                                    <span style="font-family: sans-serif">{{$pp->comment ? : 0}} </span>个评论
                                                </a>
                                            </li>
                                            @if(session('ponyid') == $pp->ponyid)
                                                <li><a href="javascript:;"><i class="fa fa-pencil"></i>
                                                        <span style="font-family: sans-serif;cursor: pointer" onclick="window.location.href='{{url('manesix_ponypost_edit/postid/'.$pp->postid)}}'">点击编辑</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="blog-pagination">
                    <ul class="pagination">
                        {{$ponypost->appends('sort',$sort)->appends('keyword',$keyword)->appends('type',$type)->links()}}
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-5">
                <div class="sidebar blog-sidebar">
                    <div class="sidebar-item  recent">
                        <h3>最新评论</h3>
                        @foreach($latest_trend as $lt)
                            <div class="media">
                                <div class="pull-left">
                                    <a href="{{url('manesix_ponypost_self/postid/'.$lt->postid)}}"><img src="{{asset($lt->avatar)}}" width="50px" alt="" style="border-radius: 50px"></a>
                                </div>
                                <div class="media-body">
                                    <h4><a href="{{url('manesix_ponypost_self/postid/'.$lt->postid)}}"></a>{{$lt->content}}</h4>
                                    <p>来源于{{$lt->title}}</p>
                                    <p>评论人：{{$lt->nickname}}</p>
                                    <p>发表于 {{$lt->created_time}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="sidebar-item categories">
                        <h3>文章类别</h3>
                        <ul class="nav navbar-stacked">
                            <li
                                    @if($type == 'all')
                                        class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?type=all&sort='.$sort}}">不限<span class="pull-right">({{$ponypost_sum}})</span></a></li>
                            <li
                                    @if($type == 'bulletin')
                                        class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?type=bulletin&sort='.$sort}}">公告<span class="pull-right">
                                        @if(array_key_exists('bulletin',$ponypost_type))
                                            ({{$ponypost_type['bulletin']}})
                                        @else
                                            (0)
                                        @endif
                                    </span></a></li>
                            <li
                                    @if($type == 'original')
                                        class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?type=original&sort='.$sort}}">原创<span class="pull-right">
                                        @if(array_key_exists('original',$ponypost_type))
                                            ({{$ponypost_type['original']}})
                                        @else
                                           (0)
                                        @endif</span></a></li>
                            <li
                                    @if($type == 'chat')
                                        class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?type=chat&sort='.$sort}}">闲聊<span class="pull-right">
                                        @if(array_key_exists('chat',$ponypost_type))
                                            ({{$ponypost_type['chat']}})
                                        @else
                                           (0)
                                        @endif</span></a></li>
                            <li
                                    @if($type == 'resource')
                                        class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?type=resource&sort='.$sort}}">资源<span class="pull-right">
                                        @if(array_key_exists('resource',$ponypost_type))
                                            ({{$ponypost_type['resource']}})
                                        @else
                                           (0)
                                        @endif</span></a></li>
                        </ul>
                    </div>
                    <div class="sidebar-item categories">
                        <h3>过滤</h3>
                        <ul class="nav navbar-stacked">
                            <li
                                    @if($sort == 'click')
                                    class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?sort=click&type='.$type}}">最多浏览文章<span class="pull-right"></span></a></li>
                            <li
                                    @if($sort == 'created_time')
                                        class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?sort=created_time&type='.$type}}">最新文章<span class="pull-right"></span></a></li>
                            <li
                                    @if($sort == 'fav')
                                        class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?sort=fav&type='.$type}}">最火文章<span class="pull-right"></span></a></li>
                            <li
                                    @if($sort == 'comment')
                                        class="active"
                                    @endif
                            ><a href="{{url('ponypost_list').'?sort=comment&type='.$type}}">最多评论文章<span class="pull-right"></span></a></li>
                            @if(session('ponyid'))
                                <li
                                        @if($sort == 'your')
                                        class="active"
                                        @endif
                                ><a href="{{url('ponypost_list').'?sort=your&type='.$type}}">你的文章<span class="pull-right"></span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection