@extends('structure.equestria_front')
@section('title','文章-'.$ponypost->title)
@section('stylesheet')
    <link href="{{asset('css/bootstrap-imageupload.css')}}" rel="stylesheet">
    <link href="{{asset('css/quill.snow.css')}}" rel="stylesheet">
    <style>
        #quill_content img{
            width:100%;
        }
    </style>
@endsection
@section('body')
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
            <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">{{$ponypost->title}}</h1>
                            <p>--{{$ponypost->nickname}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#page-breadcrumb-->
    <section id="blog-details" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="single-blog blog-details two-column">
                                <div class="post-thumb">
                                    @if(in_array($ponypost->postid,$fav))
                                        <input type="hidden" id="fav_{{$ponypost->postid}}" value="unfav">
                                    @else
                                        <input type="hidden" id="fav_{{$ponypost->postid}}" value="fav">
                                    @endif
                                    <a href="#"><img src="{{asset($ponypost->water_img)}}" class="img-responsive" alt=""></a>
                                    <div class="post-overlay">
                                        @php
                                            $pp_date = date('m-d',strtotime($ponypost->created_time));
                                            $pp_date = explode('-',$pp_date);
                                        @endphp
                                        <span class="uppercase"><a href="#">{{$pp_date[1]}} <br><small>{{config('miscellanea.mandarin_month')[$pp_date[0]]}}</small></a></span>
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold"><a href="#">{{$ponypost->title}}</a></h2>
                                    <h3 class="post-author"><a href="javascript:;">作者： {{$ponypost->nickname}}</a></h3>
                                    <h3 class="post-author"><a href="javascript:;">发表时间： {{$ponypost->created_time}}</a></h3>
                                    <div id="quill_content">
                                        <p>{!!$ponypost->content!!}</p>
                                    </div>
                                    <div class="post-bottom overflow">
                                        <ul class="nav navbar-nav post-nav">
                                            <li><a href="javascript:;"><i class="fa {{config('miscellanea.ponypost_type')[$ponypost->type]['tag']}}"></i>{{config('miscellanea.ponypost_type')[$ponypost->type]['char']}}</a></li>
                                            <li>
                                                <a href="javascript:;" onclick="luna_fav('{{$ponypost->postid}}')">
                                                    <i class="fa fa-heart"></i>
                                                    @if(!session('ponyid'))
                                                        <span id="fav_info_{{$ponypost->postid}}" style="font-family: sans-serif">{{$ponypost->fav ? : 0}} 人喜欢</span>
                                                    @else
                                                        @if(in_array($ponypost->postid,$fav))
                                                            <span id="fav_info_{{$ponypost->postid}}" style="font-family: sans-serif">{{$ponypost->fav}} 人喜欢(已喜欢)</span>
                                                        @else
                                                            <span id="fav_info_{{$ponypost->postid}}" style="font-family: sans-serif">{{$ponypost->fav ? : 0}} 人喜欢</span>
                                                        @endif
                                                    @endif
                                                </a>
                                            </li>
                                            <li><a href="#pony_comment"><i class="fa fa-comments"></i><span class="comment_total">{{$ponypost->comment}}</span> 人评论</a></li>
                                        </ul>
                                    </div>
                                    <div class="author-profile padding">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <img src="{{asset($ponypost->avatar)}}" style="border-radius: 50%;width:
                                                @if($phone_info != 'pc')
                                                        50%
                                                @else
                                                        100%
                                                @endif
                                                " alt="">
                                            </div>
                                            <div class="col-sm-10">
                                                <h2>{{$ponypost->nickname}}</h2>
                                                <p>关于作者：{{$ponypost->intro}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="response-area" id="pony_comment" >
                                        <h2 class="bold">评论区</h2>
                                        <div style="border-radius: 5px;border: 1px solid #7d7d7d" >
                                            <form class="pony_comment" action="" method="post">
                                                <input type="hidden" class="created_time" name="created_time" value="{{DATETIME}}">
                                                <input type="hidden" class="ponyid" name="ponyid" value="{{session('ponyid')}}">
                                                <input type="hidden" class="postid" name="postid" value="{{$ponypost->postid}}">
                                                <span class="respect_the_author" style="font-size: 18px;cursor: pointer;display: none"></span>
                                                <textarea class="luna_say_comment" style="width:98%;height:100px;resize:none;border:none;display:block;outline:none;" name="content" placeholder="请文明评论。。。"></textarea>
                                            </form>
                                        </div>
                                        <span class="btn btn-info" style="float: right;margin-top: 10px" onclick="buck_it_and_comment()">发表</span>
                                        <ul class="media-list luna-say-hi" id="comment_start">
                                            @foreach($comment as $c)
                                                <li class="media">
                                                    <div class="post-comment">
                                                        <div class="media-body">
                                                        <span>
                                                            <a href="#"><img class="media-object" src="{{asset($c->avatar)}}" style="border-radius: 50px;width:50px" alt="">{{$c->nickname}}:</a>
                                                        </span>
                                                            <p>{{$c->content}}</p>
                                                            <ul class="nav navbar-nav post-nav">
                                                                <li><a href="#"><i class="fa fa-clock-o"></i>{{$c->created_time}}</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div><!--/Response-area-->
                                    <span id="comment_start"></span>
                                    <div class="blog-pagination">
                                        <ul class="pagination">
                                             {{$comment->fragment('comment_start')->links()}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <p>来源于: {{$lt->title}}</p>
                                        <p>评论人：{{$lt->nickname}}</p>
                                        <p>发表于 {{$lt->created_time}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#blog-->
    @endsection

    @section('js')
        <script>
            function buck_it_and_comment(){
                var luna=$('.luna_say_comment').val();
                var ponyid=$('.ponyid').val();
                var postid=$('.postid').val();
                var date=$('.created_time').val();
                var comment_total=$('.comment_total').html() * 1 + 1;
                if(!ponyid){
                    layer.msg('请登录');
                    return false;
                }
                if(!luna){
                    layer.open({
                        title:'评论格式不太对啊',
                        content:'写点什么在发表啊'
                    })
                }else{
                    layer.msg('评论发表成功！');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'post',
                        data:'content=' + luna + '&ponyid=' + ponyid + '&postid=' + postid,
                        datatype:'json',
                        url:'{{route('manesix_ca')}}',
                        success:function (s) {
                            var comment='<li class="media">\n' +
                                '                                            <div class="post-comment">\n' +
                                '                                                <div class="media-body">\n' +
                                '                                                    <span>\n' +
                                '                                                        <a href="#"><img class="media-object" src="{{asset(session('avatar'))}}" style="border-radius: 50px;width:50px" alt="">{{session('nickname')}}:</a>\n' +
                                '                                                    </span>\n' +
                                '                                                    <p>' + luna + '</p>\n' +
                                '                                                    <ul class="nav navbar-nav post-nav">\n' +
                                '                                                        <li><a href="#"><i class="fa fa-clock-o"></i>' + date + '</a></li>\n' +
                                '                                                    </ul>\n' +
                                '                                                </div>\n' +
                                '                                            </div>\n' +
                                '                                        </li>';
                            $('.luna_say_comment').val('');
                            $('.luna-say-hi').prepend(comment);
                            $('.comment_total').html(comment_total);
                        }
                    })
                }
            }
        </script>
    @endsection

