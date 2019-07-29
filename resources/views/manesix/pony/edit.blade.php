@extends('structure.equestria_front')
@section('title','个人信息')
@section('body')
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
            <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">twijack的个人资料</h1>
                            <p>Howdy there,partner!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#action-->

    <section id="portfolio-information" class="padding-top">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger" style="background-color: orangered;color: whitesmoke">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <form action="{{route('manesix_pipe')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-2">
                        <h2 class="bold">用户头像</h2>
                        <span id="replaceImg" class="l-btn">更换图片</span>
                        <div style="width: 120px;height: 120px;border: solid 1px #555;padding: 5px;margin-top: 10px">
                            <img id="finalImg" class="img-responsive" src="{{old('avatar') ? : session('avatar')}}">
                            <input type="hidden" id="avatar" name="avatar" value="{{old('avatar') ? : session('avatar')}}">
                        </div>

                        <!--图片裁剪框 start-->
                        <div style="display: none" class="tailoring-container">
                            <div class="black-cloth" onclick="closeTailor(this)"></div>
                            <div class="tailoring-content">
                                <div class="tailoring-content-one">
                                    <label title="上传图片" for="chooseImg" class="l-btn choose-btn">
                                        <input type="file" accept="image/jpg,image/jpeg,image/png" name="file" id="chooseImg" class="hidden" onchange="selectImg(this)">
                                        选择图片
                                    </label>
                                    <div class="close-tailoring"  onclick="closeTailor(this)">×</div>
                                </div>
                                <div class="tailoring-content-two">
                                    <div class="tailoring-box-parcel">
                                        <img id="tailoringImg">
                                    </div>
                                    <div class="preview-box-parcel">
                                        <p>图片预览：</p>
                                        <div class="square previewImg"></div>
                                        <div class="circular previewImg"></div>
                                    </div>
                                </div>
                                <div class="tailoring-content-three">
                                    <span class="l-btn cropper-reset-btn">复位</span>
                                    <span class="l-btn cropper-rotate-btn">旋转</span>
                                    <span class="l-btn cropper-scaleX-btn">换向</span>
                                    <span class="l-btn sureCut" id="sureCut">确定</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="project-name overflow">
                            <h2 class="bold">{{$pony->ponyname}} </h2>
                            <ul class="nav navbar-nav navbar-default">
                                <li><a href="#">注册时间：<i class="fa fa-clock-o"></i>{{$pony->created_time}}</a></li>
                                <!--<li><a href="#"><i class="fa fa-tag"></i>Branding</a></li>-->
                            </ul>
                        </div>
                        <div class="project-info overflow">
                            <h3>昵称:</h3>

                            <p style="color: #cb555a"><input class="form-control" style="border:1px solid #9F9F9F;border-radius: 8px;text-indent:10px" type="text" name="nickname" value="{{old('nickname') ? : $pony->nickname}}"></p>

                        </div>
                        <div class="project-info overflow">
                            <h3>个人简介:</h3>

                            <p style="color: #cb555a"><textarea class="form-control" name="intro" style="resize: none;border:1px solid #9F9F9F;border-radius: 8px;width:90%;height:90px;text-indent:10px">{{old('intro') ? : $pony->intro}}</textarea></p>

                        </div>
                        <div class="live-preview">
                            <button type="submit" class="btn btn-common uppercase">完成编辑</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        (window.onresize = function () {
            var win_height = $(window).height();
            var win_width = $(window).width();
            if (win_width <= 768){
                $(".tailoring-content").css({
                    "top": (win_height - $(".tailoring-content").outerHeight())/2,
                    "left": 0
                });
            }else{
                $(".tailoring-content").css({
                    "top": (win_height - $(".tailoring-content").outerHeight())/2,
                    "left": (win_width - $(".tailoring-content").outerWidth())/2
                });
            }
        })();

        //弹出图片裁剪框
        $("#replaceImg").on("click",function () {
            $(".tailoring-container").toggle();
        });
        //图像上传
        function selectImg(file) {
            if (!file.files || !file.files[0]){
                return;
            }
            var reader = new FileReader();
            reader.onload = function (evt) {
                var replaceSrc = evt.target.result;
                //更换cropper的图片
                $('#tailoringImg').cropper('replace', replaceSrc,false);//默认false，适应高度，不失真
            }
            reader.readAsDataURL(file.files[0]);
        }
        //cropper图片裁剪
        $('#tailoringImg').cropper({
            aspectRatio: 1/1,//默认比例
            preview: '.previewImg',//预览视图
            guides: false,  //裁剪框的虚线(九宫格)
            autoCropArea: 0.5,  //0-1之间的数值，定义自动剪裁区域的大小，默认0.8
            movable: false, //是否允许移动图片
            dragCrop: true,  //是否允许移除当前的剪裁框，并通过拖动来新建一个剪裁框区域
            movable: true,  //是否允许移动剪裁框
            resizable: true,  //是否允许改变裁剪框的大小
            zoomable: false,  //是否允许缩放图片大小
            mouseWheelZoom: false,  //是否允许通过鼠标滚轮来缩放图片
            touchDragZoom: true,  //是否允许通过触摸移动来缩放图片
            rotatable: true,  //是否允许旋转图片
            crop: function(e) {
                // 输出结果数据裁剪图像。
            }
        });
        //旋转
        $(".cropper-rotate-btn").on("click",function () {
            $('#tailoringImg').cropper("rotate", 45);
        });
        //复位
        $(".cropper-reset-btn").on("click",function () {
            $('#tailoringImg').cropper("reset");
        });
        //换向
        var flagX = true;
        $(".cropper-scaleX-btn").on("click",function () {
            if(flagX){
                $('#tailoringImg').cropper("scaleX", -1);
                flagX = false;
            }else{
                $('#tailoringImg').cropper("scaleX", 1);
                flagX = true;
            }
            flagX != flagX;
        });

        //裁剪后的处理
        $("#sureCut").on("click",function () {
            if ($("#tailoringImg").attr("src") == null ){
                return false;
            }else{
                var cas = $('#tailoringImg').cropper('getCroppedCanvas');//获取被裁剪后的canvas
                var base64url = cas.toDataURL('image/png'); //转换为base64地址形式
                $("#finalImg").prop("src",base64url);//显示为图片的形式
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route('manesix_pau')}}',
                    data:'pony_image=' + base64url,
                    type:'POST',
                    success:function (s) {
                        layer.msg('头像设置成功');
                        $('#avatar').val(s);
                    },
                    error:function () {
                        layer.msg('头像设置失败');
                    }
                });

                //关闭裁剪框
                closeTailor();
            }
        });
        //关闭裁剪框
        function closeTailor() {
            $(".tailoring-container").toggle();
        }
    </script>
@endsection