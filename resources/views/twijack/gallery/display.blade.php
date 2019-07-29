@extends('structure.equestria_back')
@section('title',$appName.'-图片库列表')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>图片库列表 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @tip @endtip
                <div class="x_content">

                    <p>以下为{{$appName}} <code>图片库</code> 列表</p>
                    <div>
                        <form method="post" action="{{route('gap_d')}}">
                            @csrf
                            <div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="name" class="form-control">
                                        @foreach(config('pony.gallery') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($name) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
                                <span class="btn btn-primary"><a href="{{route('gap_op')}}" style="color: whitesmoke">新增图片库</a></span>
                            </div>
                        </form>
                    </div>

                    <div class="x_content">

                        <div class="row" id="pony">
                            @foreach($pony as $p)
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%;height:100%; display: block;" src="{{asset('path/'.$p['path'])}}" layer-src="{{asset('path/'.$p['path'])}}" alt="image" />
                                        </div>
                                        <div class="caption">
                                            <p style="text-align: center">
                                                <span style="color: purple">Name</span>:
                                                <span style="font-size: 10px">{{$p['name']}}</span>
                                                <br/>
                                                <span style="color: orange">Author</span>:
                                                <span style="font-size: 10px">{{$p['author']}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach()
                        </div>
                    </div>
                    <div class="pagination_box">
                        {{$pony->appends('name',$name)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        layer.photos({
            photos: '#pony',
            anim: 5
        });
    </script>
@endsection