@extends('structure.equestria_front')
@section('title','剧集列表')

@section('stylesheet')
    <style>
        .desc {
            display: block;
            max-width: 100%;
            height: 45px;
            margin: 0 auto;
            font-size: 14px;
            line-height: 1;
            overflow: hidden;
        }
    </style>
@endsection

@section('body')
<!--/#action-->
<section id="page-breadcrumb">
    <div class="vertical-center sun">
        <div class="container">
            <div class="row">
                <div class="action">
                    <div class="col-sm-12">
                        <h1 class="title">我的小马驹全集</h1>
                        <p>
                            <i style="color: purple;padding-right: 4px">友谊</i>
                            是
                            <i style="color: orange;padding-left: 4px">魔法</i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="blog" class="padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-7">
                <div class="row">
                    @foreach($episode as $ep)
                        <div class="col-md-6 col-sm-12 blog-padding-right">
                            <div class="single-blog two-column">
                                <div class="post-thumb">
                                    <video id="video_{{$ep->id}}" poster="{{asset('Transcend/'.$ep->poster)}}" controls preload="auto" width="380px" height="270px" data-setup="{}">
                                        <source src="{{asset('Transcend/'.$ep->source)}}" type='video/mp4'>
                                        {{--<track label="English" kind="subtitles" srclang="en" src="{{asset($ep->subtitle)}}" default>--}}
                                    </video>
                                </div>
                                <div class="post-content overflow">
                                    <h3 class="post-title bold">
                                        <a href="{{url('pony_episode_self/eid').'/'.$ep->id}}">{{$ep->name}} &nbsp;&nbsp;
                                            <span style="color: #0099AE;font-size: 15px">
                                                <img src="{{asset('star.png')}}" width="20px" style="border-radius: 50%;margin-bottom: 4px" alt=""> {{$ep->imdb_rating}}
                                            </span>
                                        </a>
                                    </h3>
                                    <h3 class="post-author">
                                        <a href="javascript:;">{{$ep->writer}}</a>
                                    </h3>
                                    <p class="desc">{{$ep->desc}}</p>
                                    <h3 class="post-author">
                                        <a href="javascript:;">release date: {{$ep->release_date}}</a>
                                    </h3>
                                    <div class="post-bottom overflow">
                                        <ul class="nav nav-justified post-nav">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-tag"></i>S{{$ep->season}}/Ep{{$ep->episode}}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-comments"></i>
                                                    弹幕 <span class="bullet_total" eid="{{$ep->id}}"></span> 个
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-hand-pointer-o"></i>
                                                    浏览 <span class="click_total"></span> {{$ep->click}} 次
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="blog-pagination">
                    <ul class="pagination">
                        {{$episode->appends([
                            'active' => $active,
                            'sort' => $sort,
                            'fan' => $fan
                        ])->links()}}
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-5">
                <div class="sidebar blog-sidebar">
                    <div class="sidebar-item categories">
                        <h3>Categories</h3>
                        <ul class="nav navbar-stacked">

                            @foreach($season as $s => $n)
                                <li
                                   @if($s == $active)
                                        class="active"
                                   @endif
                                >
                                   <a href="{{route('twijack_pel')."?active=".$s."&fan=".$fan.'&sort='.$sort}}">
                                        @if($s == 'all')
                                            All Seasons
                                        @else
                                           Season {{$s}}
                                        @endif
                                        <span class="pull-right">({{$n}})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-item categories">
                        <h3>hit episode</h3>
                        <ul class="nav navbar-stacked">
                            <li
                                @if(!$sort)
                                    class="active"
                                @endif
                            >
                                <a href="{{route('twijack_pel')."?active=".$active."&fan=".$fan}}">Friendship is Magic!</a>
                            </li>
                            <li
                                @if($sort == 'view')
                                    class="active"
                                @endif
                            >
                                <a href="{{route('twijack_pel')."?active=".$active."&sort=view&fan=".$fan}}">View is Magic!</a>
                            </li>
                            <li
                                @if($sort == 'bullet')
                                    class="active"
                                @endif
                            >
                                <a href="{{route('twijack_pel')."?active=".$active."&sort=bullet&fan=".$fan}}">Bullet is Magic!</a>
                            </li>
                            <li
                                    @if($sort == 'recent')
                                    class="active"
                                    @endif
                            >
                                <a href="{{route('twijack_pel')."?active=".$active."&sort=recent&fan=".$fan}}">Recent is Magic!</a>
                            </li>
                            <li
                               @if($sort == 'rating')
                                    class="active"
                               @endif
                            >
                                <a href="{{route('twijack_pel')."?active=".$active."&sort=rating&fan=".$fan}}">Rating is Magic!</a>
                            </li>
                        </ul>
                    </div>
                    {{--<div class="sidebar-item popular">--}}
                        {{--<h3>Latest Photos</h3>--}}
                        {{--<ul class="gallery" id="latest_photo">--}}
                            {{--@foreach($lp as $p)--}}
                                {{--<li>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--<img src="{{asset('Transcend/'.$p)}}" layer-src="{{asset('Transcend/'.$p)}}" width="80px" alt="">--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    <br/>
                    <div class="sidebar-item categories">
                        <h3>Writers</h3>
                        <ul class="nav navbar-stacked">

                            @foreach($writer as $s => $n)
                                <li
                                        @if($n['id'] == $fan)
                                            class="active"
                                        @endif
                                >
                                    <a href="{{route('twijack_pel')."?active=".$active.'&sort='.$sort."&fan=".$n['id']}}">
                                        @if($n['writer'] == 'all')
                                            All Writers
                                        @else
                                            {{$n['writer']}}
                                        @endif
                                        <span class="pull-right">({{$n['episodeCount']}})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script>
        $(function () {
            $('.bullet_total').each(function () {
                var node = $(this);

                var eid = node.attr('eid');

                $.get("{{route('twijack_bc')}}",
                    {
                        'eid':eid
                    }, function(data) {
                        node.text(data);
                    });
            });
        });

        layer.photos({
            photos: '#latest_photo',
            anim: 5
        });
    </script>
@endsection