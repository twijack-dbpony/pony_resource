@extends('structure.equestria_back')
@section('title',$text.'众筹回报')
@section('body')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$text}}众筹回报</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @alert @endalert
                    <div class="x_content">
                        <br />
                        <form id="royalwatcher_add" data-parsley-validate class="form-horizontal form-label-left" action="{{route('pcd_po')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">回报名称
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="name" placeholder="回报名称" value="{{old('name') ? : @$crowd['name']}}">
                                    <input type="hidden" name="thumb_image" class="form-control col-md-7 col-xs-12" value="{{session('thumb_image') ?? old('thumb_image') ?? @$crowd['thumb']}}">
                                    @post
                                        <input type="hidden" name="hidden_name" class="form-control col-md-7 col-xs-12" value="{{@$crowd['name']}}">
                                        <input type="hidden" class="form-control col-md-7 col-xs-12" name="id" value="{{old('id') ?? $id}}">
                                    @endpost
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">众筹等级
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="level_id" placeholder="众筹等级" value="{{old('level_id') ? : @$crowd['level_id']}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cover">回报缩略图
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
                                        @php $path = session('thumb_image') ?? old('thumb_image') ?? @$crowd['thumb'] @endphp
                                        <img id="thumb_display" src="{{asset('crowd/'.$path)}}" width="150px">
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