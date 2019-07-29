<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center bottom-separator">
                <img src="{{asset('images/home/under.png')}}" class="img-responsive inline" alt="">
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="testimonial bottom">
                    <h2>小马语录</h2>
                    <div class="media">
                        <div class="pull-left">
                            <a href=""><img src="{{asset('images/rarity.jpg')}}" style="border-radius: 50px" alt="rarity"></a>
                        </div>
                        <div class="media-body">
                            <blockquote>"Of all the worst things that could happen, this is the! Worst! Possible! Thing!"</blockquote>
                            <h3><a href="">- Rarity</a></h3>
                        </div>
                    </div>
                    <div class="media">
                        <div class="pull-left">
                            <a href=""><img src="{{asset('images/fluttershy.jpg')}}" style="border-radius: 50px" alt="fluttershy"></a>
                        </div>
                        <div class="media-body">
                            <blockquote>There is nothing fun about dragons. Scary: yes. Fun: NO!</blockquote>
                            <h3><a href="">- Fluttershy</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="testimonial bottom">
                    <h2>小马语录</h2>
                    <div class="media">
                        <div class="pull-left">
                            <a href=""><img src="{{asset('images/pinkie_pie.jpg')}}" style="border-radius: 50px" alt="pinkie_pie"></a>
                        </div>
                        <div class="media-body">
                            <blockquote>Oh, I never leave home without my party cannon!!!</blockquote>
                            <h3><a href="">- Pinkie Pie</a></h3>
                        </div>
                    </div>
                    <div class="media">
                        <div class="pull-left">
                            <a href=""><img src="{{asset('images/rainbow_dash.jpg')}}" style="border-radius: 50px" alt="rainbow_dash"></a>
                        </div>
                        <div class="media-body">
                            <blockquote>It needs to be about twenty-percent cooler.</blockquote>
                            <h3><a href="">- Rainbow Dash</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="contact-info bottom">
                    <h2>联系方式</h2>
                    <address>
                        E-mail: 1162201851@qq.com <br>
                        Phone: 13852239645 <br>
                        qq: <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1162201851&site=qq&menu=yes">diamond breach</a> <br>
                    </address>

                    <h2>同城会qq群</h2>
                    <address>
                        同城会qq群：540067469 <br>
                        华东同城会qq群：590975242 <br>
                        江苏同城会qq群：<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=0f7495536df38466e4029a0e1f16cf6f9af45dc8733ced09e8f6bb1ccd9b9952"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="JSBO-江苏Brony同城会" title="JSBO-江苏Brony同城会"></a> <br>
                        徐州同城会qq群：<a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=88762915f51c4bf01404338acf9f255a9b85667a1a3fe8bfbc9f6ee1bd82960a"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="江苏徐州brony同城会" title="江苏徐州brony同城会"></a> <br>
                    </address>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="copyright-text text-center" style="color: black">
                    <p>&copy; {{$appName}} 版权所有</p>
                    {{--<p>本站是<a href="http://bronycity.com/">小马同城会</a>的附属站</p>--}}
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/#footer-->
<script type="text/javascript" src="{{asset('js/jquery-1.10.2.js')}}"></script>
<script type="text/javascript" src="{{asset('js/cropper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('layer-v3.1.1/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.isotope.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/lightbox.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('slick-1.8.1/slick/slick.min.js')}}"></script>
@yield('script')
<script>
    var ponyid = "{{session('ponyid')}}";

    $('.pony_logout').click(function () {
        layer.msg('帐号登出成功！');
    });

    function luna_fav(postid){
        if(!ponyid){
            layer.msg('请先登陆');
        }

        var mode = $('#fav_' + postid).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            data:{'postid':postid,'ponyid':ponyid,'mode':mode},
            url:"{{route('manesix_fp')}}",
            success:function(s){
                if(s == 1){
                    layer.msg('请先登陆');
                }else if(s == 2){
                    layer.msg('你已经收藏过了');
                }else if(s == 3){
                    layer.msg('你还没有收藏此文章');
                }else{
                    layer.msg('操作成功');
                    var response = JSON.parse(s);
                    $('#fav_' + response.postid).val(response.mode);
                    $('#fav_info_' + response.postid).text(response.msg);
                }
            }
        });
    }
</script>
@yield('js')