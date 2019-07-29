@extends('structure.equestria_back')
@section('title','编辑文章信息')
@section('style')
    <link href="{{asset('css/bootstrap-imageupload.css')}}" rel="stylesheet">
@endsection
@section('body')

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>编辑文章</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if ($errors->any())
                            <div class="alert alert-danger" style="background-color: orangered;color: whitesmoke">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif(session('postscript'))
                            <div class="alert alert-danger" style="background-color: limegreen;color: whitesmoke">
                                <ul>
                                    <li>{{ session('postscript') }}</li>
                                </ul>
                            </div>
                        @endif
                        <form id="ponypost_edit" data-parsley-validate class="form-horizontal form-label-left" action="{{route('celestia_pppe')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ponypost-title">文章标题 <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="ponypost-title" name="title" class="form-control col-md-7 col-xs-12" value="{{old('title') ? : $ponypost->title}}">
                                    <input type="hidden" id="ponypost-image-url" name="fail_image_url" class="form-control col-md-7 col-xs-12" value="{{old('fail_image_url') ? : $ponypost->water_img}}">
                                    <input type="hidden" id="postid" name="postid" class="form-control col-md-7 col-xs-12" value="{{old('postid') ? : $ponypost->postid}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ponypost-desc">文章简介
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="ponypost-desc" name="desc" class="form-control col-md-7 col-xs-12" value="{{old('desc') ? : $ponypost->description}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">类型</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary">
                                            <input type="radio" class="flat" name="type" value="bulletin"
                                                @if($ponypost->type=="bulletin" || old('type') == 'bulletin')
                                                   checked="checked"
                                                @endif
                                            > &nbsp; 公告 &nbsp;
                                        </label>
                                        <label class="btn btn-dark">
                                            <input type="radio" class="flat" name="type" value="resource"
                                                @if($ponypost->type=="resource" || old('type') == 'resource')
                                                   checked="checked"
                                                @endif
                                            > &nbsp; 资源 &nbsp;
                                        </label>
                                        <label class="btn btn-info">
                                            <input type="radio" class="flat" name="type" value="chat"
                                                 @if($ponypost->type=="chat" || old('type') == 'chat')
                                                   checked="checked"
                                                 @endif
                                            > &nbsp; 闲谈 &nbsp;
                                        </label>
                                        <label class="btn btn-warning">
                                            <input type="radio" class="flat" name="type" value="original"
                                                @if($ponypost->type=="original" || old('type') == 'original')
                                                   checked="checked"
                                                @endif
                                            > &nbsp; 原创 &nbsp;
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="icon">文章缩略图 <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input onchange="display_image('thumb','thumb_display')" type="file" id="thumb" name="thumb" class="col-md-7 col-xs-12" style="width: 80px;height: 31px;overflow: hidden;position: relative;z-index: 8;opacity: 0;">
                                    <span style="margin-left:10px; position: absolute;left: 0; display: inline-block;width: 80px; padding: 2px 8px;line-height: 30px;border: 2px solid #ddd;cursor: pointer;">上传图片</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img id="thumb_display" width="
                                    @if(session('fail_image_url') || $ponypost->water_img)
                                            100%
                                    @endif
                                            " src="
                                    @if(session('fail_image_url') || $ponypost->water_img)
                                        {{asset(session('fail_image_url') ? : $ponypost->water_img)}}
                                    @endif
                                            ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>文章内容</label>
                                <textarea id="textbox" name="content" style="width: 100%; height: 400px;">{!! old('content') ? : $ponypost->content !!}</textarea>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <button class="btn btn-success ponypost_edit_btn">完成编辑</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{asset('js/bootstrap-imageupload.js')}}"></script>
@endsection

@section('js')
        function display_image(id,img) {
            var file = document.getElementById(id).files[0];
            var reader  = new FileReader();
            reader.onload = function(e)  {
                var image = document.getElementById(img);
                image.src = e.target.result;
                image.style.width = '100%';
            }
            reader.readAsDataURL(file);
        };
@endsection


