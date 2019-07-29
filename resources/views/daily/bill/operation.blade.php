@extends('structure.equestria_back')
@section('title',$appName.'-'.$text.'db日常账单')
@section('body')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$text}}db日常账单</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @alert @endalert
                    <div class="x_content">
                        <br />
                        <form id="royalwatcher_add" data-parsley-validate class="form-horizontal form-label-left" action="{{route('d_spo')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">金额
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="bucks" value="{{old('bucks') ? : @$bill['bucks']}}">
                                    @if(request()->get('m') == 'e')
                                        <input type="hidden" class="form-control col-md-7 col-xs-12" name="id" value="{{$id}}">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">账单类型</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="type" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-danger">
                                            <input type="radio" class="flat" name="type" value="1"
                                                   @if((old('type') ? : @$bill['type']) == 1 || !(old('type') ? : @$bill['type']))
                                                        checked
                                                   @endif
                                            > &nbsp; 支出 &nbsp;
                                        </label>
                                        <label class="btn btn-warning">
                                            <input type="radio" class="flat" name="type" value="2"
                                                   @if((old('type') ? : @$bill['type']) == 2)
                                                        checked
                                                   @endif
                                            > &nbsp; 收入 &nbsp;
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">支出分类
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="categoryP" class="form-control">
                                        @foreach(config('constants.pay') as $k => $v)
                                            @if($k == 'all')
                                                @continue
                                            @endif
                                            <option value="{{$k}}"
                                                    @if((old('categoryP') ? : @$bill['categoryP']) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">收入分类
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="categoryR" class="form-control">
                                        @foreach(config('constants.receive') as $k => $v)
                                            @if($k == 'all')
                                                @continue
                                            @endif
                                            <option value="{{$k}}"
                                                    @if((old('categoryR') ? : @$bill['categoryR']) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">文本补充
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="consumeText" value="{{old('consumeText') ? : @$bill['consumeText']}}">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-success royalwatcher_add">{{$text}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


