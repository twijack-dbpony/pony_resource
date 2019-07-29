@extends('structure.equestria_back')
@section('title',$appName.'-个人设置')
@section('body')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>个人设置</h2>
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
                        <br />
                        <form id="royalwatcher_pw" data-parsley-validate class="form-horizontal form-label-left" action="{{route('celestia_rpu')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">新密码
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" name="password" class="form-control col-md-7 col-xs-12" value="{{old('password')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">确认密码
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" name="confirm" class="form-control col-md-7 col-xs-12" value="{{old('confirm')}}">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-success royalwatcher_add">修改</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


