@extends('structure.equestria_front')
@section('title',$episode->name)
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('dist/css/danmuplayer.css')}}">
@endsection
@section('body')
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
            <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title"><strong>{{$episode->name}}</strong></h1>
                            <p>{!! 'Now watching <i style="color:purple">Season</i><span style="font-size:21px;padding-left:4px;color:purple">'.$episode->season.' </span><i style="color:orange">Episode</i><span style="font-size:21px;padding-left:4px;color:orange">'.$episode->episode.'</span>' !!}</p>
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
                                        <div id="danmup" style="position: relative"></div>
                                    </div>
                                    <div class="post-content overflow">
                                        <h2 class="post-title bold">
                                            <a style="font-size: 28px" href="#">
                                                <strong>{{$episode->name}}</strong>
                                            </a>
                                            <sub style="font-size: 15px;color: black;padding-left:10px;opacity: 0.5;">首播日期:{{$episode->release_date}}</sub>
                                        </h2>
                                        <div style="clear: both"></div>
                                        <p style="font-size: 18px;margin-top: 10px;color: #0099AE">{{$episode->writer}}</p>
                                        <p style="font-size: 18px;margin-top: 10px;color: #0099AE">
                                            <strong>内容简介：</strong>
                                        </p>
                                        <p style="font-size: 16px;margin-top: 10px;">{{$episode->desc}}</p>
                                        <div class="post-bottom overflow">
                                            <ul class="nav navbar-nav post-nav">
                                                <li>
                                                    <a href="javascript:;" onclick="">
                                                        <i class="fa fa-comments"></i>
                                                        弹幕 <span class="comment_total"></span> 个
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                        <i class="fa fa-hand-pointer-o"></i>
                                                        浏览 <span class="click_total">{{$episode->click}}</span> 次
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                    <i class="fa fa-database"></i>
                                                    <span style="color: #0099AE;font-size: 15px">
                                                        imdb评分
                                                        <img src="{{asset('star.png')}}" width="20px" style="border-radius: 50%;margin-bottom: 4px" alt=""> {{$episode->imdb_rating}}
                                                    </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <p style="font-size: 18px;margin-top: 20px;color: #0099AE">
                                            <strong>出场角色({{$pony->count()}})：</strong>
                                        </p>
                                        <div class="post-bottom overflow">
                                            @foreach($pony as $p)
                                                <img src="{{asset('thumb/'.$p->thumb)}}" width="50px" alt="" style="border-radius: 50%" title="{{$p->name}}" onclick="ponyDetail('{{url('game/pony/detail',$p->id)}}')">
                                            @endforeach
                                        </div>
                                        <p style="font-size: 16px;margin-top: 10px;text-indent: 40px"></p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-5">
                    <div class="sidebar blog-sidebar">
                        <div class="sidebar-item categories">
                            <h3>Seasons</h3>
                            <ul class="nav navbar-stacked">
                                @foreach($season as $s => $n)
                                    @if($s == 'all')
                                        @continue
                                    @endif
                                    <li
                                        @if($episode->season == $s)
                                            class="active"
                                        @endif
                                    >
                                        <a href="{{route('twijack_pel')."?active=".$s}}">Season {{$s}}<span class="pull-right">({{$n}})</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar-item popular">
                            <h3>Latest Photos</h3>
                            <ul class="gallery" id="latest_photo">
                                @foreach($lp as $p)
                                    <li>
                                        <a href="javascript:;">
                                            <img src="{{asset('Transcend/'.$p)}}" layer-src="{{asset('Transcend/'.$p)}}" alt="">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{asset('dist/js/danmuplayer.js')}}" type="application/javascript"></script>
@endsection
@section('js')
    <script type="application/javascript">
        $("#danmup").danmuplayer({
            src:"{{asset('Transcend/'.$episode->source)}}",
            height: 600,
            width: 800,
            speed: 15000,
            url_to_get_danmu: "{{route('twijack_bg').'?eid='.$episode->id}}",
            url_to_post_danmu: "{{route('twijack_bs').'?eid='.$episode->id}}"
        });

        $(function(){
           {{--$('#bullets').after('<track label="English" kind="subtitles" srclang="en" src="{{asset($episode->subtitle)}}" default>');--}}
           $('#danmu_video_html5_api').attr('poster','{{asset('Transcend/'.$episode->poster)}}')
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{'eid':'{{$episode->id}}'},
            type:'post',
            url:'{{route('twijack_bc')}}',
            success:function (s) {
                $('.comment_total').html(s);
            }
        });

        layer.photos({
            photos: '#latest_photo',
            anim: 5
        });

        function ponyDetail(url) {
            $.ajax({
                url:url,
                type:'get',
                success:function (s) {
                    layer.open({
                        title:'',
                        content:'<p style="text-align:center">' +
                            '<img style="border-radius:50%;width:60px;" ' +
                            'src="{{request()->getSchemeAndHttpHost()}}' + s.thumb + '" alt="' + s.name + '"></p>' +
                            '<h2 style="text-align:center;">' + s.name + '</h2>' +
                            '<h5 style="text-align:center;"><span style="color:orange">' + s.race + '</span>&nbsp;&nbsp;&nbsp;<span style="color:purple">' + s.sex + '</span></h5>' +
                            '<p style="text-align:center;">' + s.desc + '</p>'
                    })
                }
            });
        }
    </script>
@endsection