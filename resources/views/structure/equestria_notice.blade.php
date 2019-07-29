<h1 class="error-number" style="color: {{$aj}};text-shadow:3px 3px {{$ts}}">{{$code}}</h1>
<h1 style="color: {{$ts}}">{{$slot}}</h1>

<img src="{{asset('images/'.$image)}}" width="100px" style="margin-bottom: 10px;border-radius: 50%" alt="">
<p style="color: {{$aj}};font-size: 20px">{{$caption}}</p>
<p style="color: {{$aj}};font-size: 20px">{{$subtitle}}</p>
<div class="mid_center">
    <span class="btn" style="background-color: {{$ts}};border: 1px solid {{$ts}};color:whitesmoke" onclick="window.location.href='{{route('twijack_pel')}}'">返回小马国</span>
</div>