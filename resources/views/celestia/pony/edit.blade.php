@extends('structure.equestria_back')
@section('title','编辑成员信息')
@section('body')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>编辑成员信息</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger" style="background-color: orangered;color: whitesmoke">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="x_content">
                        <br />
                        <form id="pony_edit" data-parsley-validate class="form-horizontal form-label-left" action="{{route('celestia_ppe')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <h3 style="text-align: center">成员信息:</h3>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ponyname">成员帐号
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" class="form-control col-md-7 col-xs-12" name="ponyid" value="{{old('ponyid') ? : $pony->ponyid}}">
                                    <input type="hidden" class="form-control col-md-7 col-xs-12" name="ponyname" value="{{old('ponyname') ? : $pony->ponyname}}">
                                    <input type="hidden" class="form-control col-md-7 col-xs-12" name="nickname" value="{{old('nickname') ? : $pony->nickname}}">
                                    <input type="text" id="ponyname" disabled class="form-control col-md-7 col-xs-12" value="{{old('ponyname') ? : $pony->ponyname}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nickname">昵称
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="nickname" disabled class="form-control col-md-7 col-xs-12" value="{{old('nickname') ? : $pony->nickname}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="avatar">头像
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img src="{{asset(old('avatar') ? : $pony->avatar)}}" alt="" width="50%" height="50%" style="border-radius: 50%">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">新密码
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" value="{{old('password')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">确认密码
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="confirm" name="confirm" class="form-control col-md-7 col-xs-12" value="{{old('confirm')}}">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-success pony_add">完成编辑</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

