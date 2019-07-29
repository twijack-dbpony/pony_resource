@extends('structure.equestria_back')
@section('title',$appName.'-db日常账单')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>db日常账单 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @if(session('postscript'))
                    <div class="alert alert-danger" style="background-color: limegreen;color: whitesmoke">
                        <ul>
                            <li>{{ session('postscript') }}</li>
                        </ul>
                    </div>
                @endif
                <div class="x_content">

                    <p>以下为华东小马 <code>db日常账单</code> 列表</p>
                    <div>
                        <form method="post" action="{{route('d_psd')}}">
                            @csrf
                            <div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input class="form-control" type="text" name="keyword" placeholder="keyword" value="{{$keyword}}">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="type" class="form-control">
                                        @foreach(config('constants.typeSearch') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($type) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="categoryP" class="form-control">
                                        @foreach(config('constants.pay') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($categoryP) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="categoryR" class="form-control">
                                        @foreach(config('constants.receive') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($categoryR) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
                                <span class="btn btn-primary"><a href="{{route('d_pso')}}" style="color: whitesmoke">新增db日常账单</a></span>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th>
                                </th>
                                <th class="column-title"> </th>
                                <th class="column-title">金额汇总 </th>
                                <th class="column-title">¥{{$sum}} </th>
                                <th class="column-title"> </th>
                                <th class="column-title"> </th>
                                <th class="column-title"> </th>
                                <th class="column-title no-link last"><span class="nobr"></span>
                                </th>
                                <th class="bulk-actions" colspan="9">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">id </th>
                                <th class="column-title" style="min-width: 400px">文本补充 </th>
                                <th class="column-title">金额 </th>
                                <th class="column-title" style="min-width: 100px">账单类型 </th>
                                <th class="column-title">分类 </th>
                                <th class="column-title" style="min-width: 200px">添加时间 </th>
                                <th class="column-title no-link last" style="min-width: 100px"><span class="nobr">行为</span>
                                </th>
                                <th class="bulk-actions" colspan="9">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($bill as $b)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" ">{{$b->id}}</td>
                                    <td class=" ">{{$b->consumeText}}</td>
                                    <td class=" ">¥{{$b->bucks}}</td>
                                    <td class=" " style="color: {{config('constants.type')[$b->type]['c']}}">{{config('constants.type')[$b->type]['t']}}</td>
                                    <td class=" ">
                                        @if($b->type == 1)
                                            {{config('constants.pay')[$b->categoryP]}}
                                        @elseif($b->type == 2)
                                            {{config('constants.receive')[$b->categoryR]}}
                                        @endif
                                    </td>
                                    <td class=" ">{{$b->created_at}}</td>
                                    <td class=" last">
                                        <a href="{{route('d_pso').'/'.$b->id.'?m=e'}}" style="cursor: pointer">编辑</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$bill->appends([
                                'type' => $type,
                                'keyword' => $keyword,
                                'categoryP' => $categoryP,
                                'categoryR' => $categoryR
                        ])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection