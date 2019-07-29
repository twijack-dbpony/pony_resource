@extends('structure.equestria_front')
@section('title','发表文章')
@section('stylesheet')
    <link href="{{asset('css/bootstrap-imageupload.css')}}" rel="stylesheet">
    <link href="{{asset('css/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('css/uploadpreview.css')}}" rel="stylesheet">
    <script type='text/javascript' src={{asset('textboxio-all/textboxio/textboxio.js')}}></script>
@endsection
<style>
    input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: whitesmoke;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: lightskyblue;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid whitesmoke;
    }
</style>
@section('body')
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
            <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">发表文章</h1>
                            <p>请认真并文明地编写文章</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#action-->

    <section id="portfolio-information" class="padding-top">
        <div class="container">
            <div class="row" style="margin: 20px">
                <div class="right_col" role="main">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    @if ($errors->any())
                                        <div class="alert alert-danger" style="background-color: orangered;color: whitesmoke">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form id="ponypost_create" data-parsley-validate class="form-horizontal form-label-left" action="{{route('manesix_pppc')}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ponypost-title">文章标题 <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="ponypost-title" name="title" class="form-control col-md-7 col-xs-12" value="{{old('title')}}">
                                                <input type="hidden" id="ponypost-image-url" name="url" value="{{old('url')}}">
                                                <input type="hidden" name="fail_image_url" value="{{session('fail_image_url')}}">
                                                <input type="hidden" name="ponyid" value="{{session('ponyid')}}">
                                                <span style="color: red;border-radius: 3px 4px 4px 3px;max-width: 170px;white-space: pre;" class="ponypost-title-error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ponypost-desc">文章简介
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="ponypost-desc" name="desc" class="form-control col-md-7 col-xs-12" value="{{old('desc')}}">
                                                <span style="color: red;border-radius: 3px 4px 4px 3px;max-width: 170px;white-space: pre;" class="ponypost-desc-error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">类型</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div id="type" class="btn-group">
                                                    <input type="radio" class="flat" name="type" value="bulletin"
                                                        @if(old('type') == 'bulletin')
                                                            checked="checked"
                                                        @endif
                                                    >
                                                    <label style="background-color: violet;border-radius: 20px;width: 40px;text-align: center;color: whitesmoke">公告</label>
                                                    <input type="radio" class="flat" name="type" value="resource"
                                                        @if(old('type') == 'resource')
                                                           checked="checked"
                                                        @endif
                                                    >
                                                    <label style="background-color: darkgoldenrod;border-radius: 20px;width: 40px;text-align: center;color: whitesmoke">资源</label>
                                                    <input type="radio" class="flat" name="type" value="chat"
                                                        @if(old('type') == 'chat' || !old('type'))
                                                           checked="checked"
                                                        @endif
                                                    >
                                                    <label style="background-color: dimgrey;border-radius: 20px;width: 40px;text-align: center;color: whitesmoke">闲聊</label>
                                                    <input type="radio" class="flat" name="type" value="original"
                                                        @if(old('type') == 'original')
                                                           checked="checked"
                                                        @endif
                                                    >
                                                    <label style="background-color: limegreen;border-radius: 20px;width: 40px;text-align: center;color: whitesmoke;">原创</label>
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
                                                @if(session('fail_image_url'))
                                                        100%
                                                @endif
                                                " src="
                                                @if(session('fail_image_url'))
                                                        {{asset(session('fail_image_url'))}}
                                                @endif
                                                        ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>文章内容</label>
                                            <textarea id="textbox" name="content" style="width: 100%; height: 400px;">{{old('content')}}</textarea>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success ponypost_create_btn" style="margin-top: 10px">完成编辑</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#portfolio-information-->

    <section id="related-work" class="padding-top padding-bottom">
    </section>
    @endsection

    @section('script')
        <script src="{{asset('js/bootstrap-imageupload.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/uploadpreview.min.js')}}"></script>
    @endsection

    @section('js')
        <script>
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
        </script>
    @endsection
