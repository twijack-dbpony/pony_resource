@extends('structure.equestria_back')
@section('title',$text.'小马')
@section('body')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$text}}小马</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @alert @endalert
                    <div class="x_content">
                        <br />
                        <form id="royalwatcher_add" data-parsley-validate class="form-horizontal form-label-left" action="{{route('gp_po')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">小马名称
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="name" placeholder="小马名称" value="{{old('name') ? : @$pony['name']}}">
                                    <input type="hidden" name="thumb_image" class="form-control col-md-7 col-xs-12" value="{{session('thumb_image') ?? old('thumb_image') ?? @$pony['thumb']}}">
                                    @post
                                        <input type="hidden" class="form-control col-md-7 col-xs-12" name="id" value="{{old('id') ?? $id}}">
                                    @endpost
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">性别
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="sex" class="form-control">
                                        @foreach(config('pony.sex') as $k => $v)
                                            @if($k == 'all')
                                                @continue
                                            @endif
                                            <option value="{{$k}}"
                                                    @if((old('sex') ? : @$pony['sex']) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">种族
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="race" class="form-control">
                                        @foreach(config('pony.race') as $k => $v)
                                            @if($k == 'all')
                                                @continue
                                            @endif
                                            <option value="{{$k}}"
                                                    @if((old('race') ? : @$pony['race']) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">地区
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="location" class="form-control">
                                        @foreach(config('pony.location') as $k => $v)
                                            @if($k == 'all')
                                                @continue
                                            @endif
                                            <option value="{{$k}}"
                                                    @if((old('location') ? : @$pony['location']) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">是否拥有
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="own" class="form-control">
                                        @foreach(config('pony.own') as $k => $v)
                                            @if($k == 'all')
                                                @continue
                                            @endif
                                            <option value="{{$k}}"
                                                    @if((old('own') ? : @$pony['own']) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">支付方式
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="price_type" class="form-control">
                                        @foreach(config('pony.type') as $k => $v)
                                            @if($k == 'all')
                                                @continue
                                            @endif
                                            <option value="{{$k}}"
                                                    @if((old('price_type') ? : @$pony['price_type']) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">支付数量
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="price" value="{{old('price') ? : @$pony['price']}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">星级
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="star" value="{{old('star') ? : @$pony['star']}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">简要描述
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="desc" value="{{old('desc') ? : @$pony['desc']}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cover">小马缩略图
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onchange="display_image('thumb','thumb_display',150)" type="file" id="thumb" name="thumb" class="col-md-7 col-xs-12" style="width: 80px;height: 31px;overflow: hidden;position: relative;z-index: 8;opacity: 0;">
                                    <span style="margin-left:10px; position: absolute;left: 0; display: inline-block;width: 80px; padding: 2px 8px;line-height: 30px;border: 2px solid #ddd;cursor: pointer;">上传图片</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if(!session('thumb_image') && !$id && !old('thumb_image'))
                                        <img id="thumb_display" src="">
                                    @else
                                        @php $thumb = session('thumb_image') ?? old('thumb_image') ?? @$pony['thumb'] @endphp
                                        <img id="thumb_display" src="{{asset('thumb/'.$thumb)}}">
                                    @endif
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-success">{{$text}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection