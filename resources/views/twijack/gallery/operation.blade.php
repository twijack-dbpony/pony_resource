@extends('structure.equestria_back')
@section('title',$text.'小马图库')
@section('body')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$text}}小马图库</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @alert @endalert
                    <div class="x_content">
                        <br />
                        <form id="royalwatcher_add" data-parsley-validate class="form-horizontal form-label-left" action="{{route('gap_po')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">图片名称
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="name" placeholder="图片名称" value="{{old('name') ? : @$pony['name']}}">
                                    <input type="hidden" name="path_image" class="form-control col-md-7 col-xs-12" value="{{session('path_image') ?? old('path_image') ?? @$pony['path']}}">
                                    @post
                                        <input type="hidden" class="form-control col-md-7 col-xs-12" name="id" value="{{old('id') ?? $id}}">
                                    @endpost
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">作者
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="author" placeholder="作者" value="{{old('author') ? : @$pony['author']}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cover">缩略图
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onchange="display_image('path','path_display',150)" type="file" id="path" name="path" class="col-md-7 col-xs-12" style="width: 80px;height: 31px;overflow: hidden;position: relative;z-index: 8;opacity: 0;">
                                    <span style="margin-left:10px; position: absolute;left: 0; display: inline-block;width: 80px; padding: 2px 8px;line-height: 30px;border: 2px solid #ddd;cursor: pointer;">上传图片</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if(!session('path_image') && !$id && !old('path_image'))
                                        <img id="path_display" src="">
                                    @else
                                        @php $path = session('path_image') ?? old('path_image') ?? @$pony['path'] @endphp
                                        <img id="path_display" src="{{asset('path/'.$path)}}">
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