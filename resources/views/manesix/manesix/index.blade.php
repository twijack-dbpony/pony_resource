<!--/#home-slider-->
@extends('structure.equestria_front')
@section('title',$appName)
@section('body')
    <section id="services">
        <div cfoolass="container">
            @if(session('postscript'))
            <div class="alert alert-danger" style="background-color: limegreen;color: whitesmoke">
                <ul style="list-style: none">
                    <li>{{ session('postscript') }}</li>
                </ul>
            </div>
            @endif
            <div class="row" id="slick_images">
                <div class="slick_images" style="margin-left: 40px">
                    @for($slick = 1; $slick <= config('constants.slick'); $slick ++)
                        <div>
                            <img style="width: 80%;border-radius: 50%" src="{{asset('slick/slick_'.$slick.'.'.config('constants.imageExtension'))}}" alt="">
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <section id="features">
        <div class="container">
            <div class="row">
                <div class="single-features">
                    <div class="col-sm-5 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                        <a href="{{url('manesix_ponypost_self/postid/'.$ponypost[0]->postid)}}"><img src="{{$ponypost[0]->water_img}}" class="img-responsive" alt=""></a>
                    </div>
                    <div class="col-sm-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h2><i class="fa {{config('miscellanea.ponypost_type')[$ponypost[0]->type]['tag']}}"></i><span style="color: black;font-size: 16px;margin-left: 5px">{{config('miscellanea.ponypost_type')[$ponypost[0]->type]['char']}}</span>:&nbsp;&nbsp;<a href="{{url('manesix_ponypost_self/postid/'.$ponypost[0]->postid)}}" style="color: #7d7d7d">{{$ponypost[0]->title}}</a></h2>
                        <P>文章简介：{{$ponypost[0]->description}}</P>
                        <P><img style="border-radius: 50%" width="30px" height="30px" src="{{asset($ponypost[0]->avatar)}}">&nbsp;{{$ponypost[0]->nickname}}&nbsp;&nbsp;</P>
                        <p><i class="fa fa-heart"></i>&nbsp;{{$ponypost[0]->fav}}人喜欢&nbsp;&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;{{$ponypost[0]->comment}}人评论</p>
                    </div>
                </div>
                <div class="single-features">
                    <div class="col-sm-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h2><i class="fa {{config('miscellanea.ponypost_type')[$ponypost[1]->type]['tag']}}"></i><span style="color: black;font-size: 16px;margin-left: 5px">{{config('miscellanea.ponypost_type')[$ponypost[1]->type]['char']}}</span>:&nbsp;&nbsp;<a href="{{url('manesix_ponypost_self/postid/'.$ponypost[1]->postid)}}" style="color: #7d7d7d">{{$ponypost[1]->title}}</a></h2>
                        <P>文章简介：{{$ponypost[1]->description}}</P>
                        <P><img style="border-radius: 50%" width="30px" height="30px" src="{{asset($ponypost[1]->avatar)}}">&nbsp;{{$ponypost[1]->nickname}}&nbsp;&nbsp;</P>
                        <p><i class="fa fa-heart"></i>&nbsp;{{$ponypost[1]->fav}}人喜欢&nbsp;&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;{{$ponypost[1]->comment}}人评论</p>
                    </div>
                    <div class="col-sm-5 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                        <a href="{{url('manesix_ponypost_self/postid/'.$ponypost[1]->postid)}}"><img src="{{$ponypost[1]->water_img}}" class="img-responsive" alt=""></a>
                    </div>
                </div>
                <div class="single-features">
                    <div class="col-sm-5 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                        <a href="{{url('manesix_ponypost_self/postid/'.$ponypost[2]->postid)}}"><img src="{{$ponypost[2]->water_img}}" class="img-responsive" alt=""></a>
                    </div>
                    <div class="col-sm-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                        <h2><i class="fa {{config('miscellanea.ponypost_type')[$ponypost[2]->type]['tag']}}"></i><span style="color: black;font-size: 16px;margin-left: 5px">{{config('miscellanea.ponypost_type')[$ponypost[2]->type]['char']}}</span>:&nbsp;&nbsp;<a href="{{url('manesix_ponypost_self/postid/'.$ponypost[2]->postid)}}" style="color: #7d7d7d">{{$ponypost[2]->title}}</a></h2>
                        <P>文章简介：{{$ponypost[2]->description}}</P>
                        <P><img style="border-radius: 50%" width="30px" height="30px" src="{{asset($ponypost[2]->avatar)}}">&nbsp;{{$ponypost[2]->nickname}}&nbsp;&nbsp;</P>
                        <p><i class="fa fa-heart"></i>&nbsp;{{$ponypost[2]->fav}}人喜欢&nbsp;&nbsp;&nbsp;<i class="fa fa-comment"></i>&nbsp;{{$ponypost[2]->comment}}人评论</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('.slick_images').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
        });

        layer.photos({
            photos: '#slick_images',
            anim: 5
        });
    </script>
@endsection()
