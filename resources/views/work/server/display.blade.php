@extends('structure.equestria_back')
@section('title',$appName.'-服务器信息')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>服务器信息 </h2>
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

                    <p>以下为{{$appName}} <code>服务器信息</code> 列表</p>
                    <div>
                        <form method="post" action="{{route('w_psd')}}">
                            @csrf
                            <div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <input class="form-control" type="text" name="ip" placeholder="ip" value="{{$ip}}">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <input class="form-control" type="text" name="type" placeholder="类型" value="{{$type}}">
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
                                <span class="btn btn-primary"><a href="{{route('w_pso')}}" style="color: whitesmoke">新增服务器信息</a></span>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">id </th>
                                <th class="column-title">用户名 </th>
                                <th class="column-title">密码 </th>
                                <th class="column-title">类型 </th>
                                <th class="column-title">ip/domain </th>
                                <th class="column-title">端口 </th>
                                <th class="column-title no-link last"><span class="nobr">行为</span>
                                </th>
                                <th class="bulk-actions" colspan="9">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($server as $s)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" ">{{$s->id}}</td>
                                    <td class=" ">{{$s->username}}</td>
                                    <td class=" ">{{$s->password}}</td>
                                    <td class=" ">{{$s->type}}</td>
                                    <td class=" ">{{$s->ip}}</td>
                                    <td class=" ">{{$s->port ?? 'none'}}</td>
                                    <td class=" last">
                                        <a href="{{route('w_pso').'/'.$s->id.'?m=e'}}" style="cursor: pointer">编辑</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$server->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection