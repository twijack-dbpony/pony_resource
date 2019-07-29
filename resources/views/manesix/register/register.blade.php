<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$appName}}注册</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/form-elements.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/cropper.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ImgCropping.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->

    <link rel="shortcut icon" href="{{asset('images/PearButter.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/144x144.jpg')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/114x114.jpg')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/72x72.jpg')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/57x57.jpg')}}">
</head>

<body>

<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text">

                    <h1>{{$appName}}注册</h1>
                    <div class="description">
                        <p>

                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        @if ($errors->any())
                            <div class="alert alert-danger" style="background-color: orangered;color: whitesmoke;opacity: 0.8">
                                <ul style="list-style: none">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-top-left">
                            <h3>想要加入我们吗？</h3>
                            <p>请填写以下基本信息</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" id="luna_form" action="{{route('manesix_pr')}}" method="post" class="login-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="sr-only" for="form-username">用户名</label>
                                <input type="text" name="ponyname" id="ponyname" placeholder="用户名..." class="form-username form-control" value="{{old('ponyname')}}">
                                <span style="color: red;" id="duplicate"></span>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-email">密码</label>
                                <input type="password" name="password" placeholder="密码..." class="form-username form-control" id="password" value="{{old('password')}}">
                                <span style="color: red;" id="password_error"></span>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-email">确认密码</label>
                                <input type="password" name="confirm" placeholder="确认密码..." class="form-username form-control" id="confirm" value="{{old('confirm')}}">
                                <input type="hidden" name="avatar" class="form-control" id="avatar" value="{{old('avatar') ? : 'assets/img/default.png'}}">
                                <span style="color: red;" id="confirm_error"></span>
                            </div>
                            <div class="form-group">
                                <span id="replaceImg" class="l-btn" style="width: 100%;text-align: center;font-size: 16px">选择头像</span>
                                <div style="width: 240px;height: 240px;padding: 5px;margin: 0 auto;border-radius: 120px">
                                    <img style="border-radius: 120px" id="finalImg" class="img-responsive" src="{{asset(old('avatar') ? : 'assets/img/default.png')}}">
                                </div>
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
                            <div class="form-group">
                                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码" style="margin: 0 auto;margin-bottom: 15px;width: 100%;height: 65px">
                                <label class="sr-only" for="form-email">验证码</label>
                                <input type="text" name="captcha" id="captcha" placeholder="验证码..." class="form-username form-control">
                                <span style="color: red;" id="captcha_error"></span>
                            </div>
                            <button type="submit" class="btn btn-warning">注册!</button>
                            {{--<button class="btn btn-primary">报名!</button>--}}
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 social-login">
                    <h3>...或许你想:</h3>
                    <div class="social-login-buttons">
                        <a class="btn btn-link-2" href="{{route('manesix_l')}}">
                            <i class="fa fa-table"></i>我已经注册过了
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('layer-v3.1.1/layer.js')}}"></script>
<script src="{{asset('assets/js/cropper.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.backstretch.min.js')}}"></script>
<script src="{{asset('js/register_scripts.js')}}"></script>

<script>
    (window.onresize = function () {
        var win_width = $(window).width();
        if (win_width <= 768){
            $(".tailoring-content").css({
                "top": 50,
                "left": 0
            });
        }else{
            $(".tailoring-content").css({
                "top": 25,
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
</body>

</html>