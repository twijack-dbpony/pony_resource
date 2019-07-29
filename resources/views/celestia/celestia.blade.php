@extends('structure.equestria_back')
@section('title',$appName.'-后台')
@section('body')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> 小马剧集 <small> Gif Gallery</small> </h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>小马剧集 <small> Gif Gallery </small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="row">

                                <p>Gif Gallery</p>
                                @foreach($episode as $e)
                                    <div class="col-md-55">
                                        <div class="thumbnail">
                                            <div class="image view view-first">
                                                <img style="width: 100%; display: block;" src="{{asset('Transcend/'.$e['poster'])}}" alt="image" />
                                                <div class="mask">
                                                    <p>
                                                        <a style="color: whitesmoke" href="{{url('pony_episode_self/eid').'/'.$e['id']}}" target="_blank">
                                                            {{'S'.$e['season'].' Ep'.$e['episode'].':'.$e['name']}}
                                                        </a>
                                                    </p>
                                                    <div class="tools tools-bottom">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p>{!! '<span style="color:purple">S'.$e['season'].'</span><span style="color:orange"> Ep'.$e['episode'].'</span>:'.$e['name'] !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach()
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
