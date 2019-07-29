@extends('structure.equestria_back')
@section('title',$appName.'-管理员列表')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>管理员列表 </h2>
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

                    <p>以下为华东小马 <code>管理员</code> 列表</p>
                    <div>
                        <form method="post" action="{{route('celestia_rl')}}">
                            {{csrf_field()}}
                            <div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <input class="form-control" type="text" name="keyword" placeholder="管理员名称" value="{{$keyword}}">
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
                                <span class="btn btn-primary"><a href="{{route('celestia_ra')}}" style="color: whitesmoke">新增管理员</a></span>
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
                                <th class="column-title">头像 </th>
                                <th class="column-title">名称 </th>
                                <th class="column-title">身份 </th>
                                <th class="column-title">登录时间 </th>
                                <th class="column-title">ip </th>
                                <th class="column-title">浏览器 </th>
                                <th class="column-title">手机信息 </th>
                                <th class="column-title">操作系统 </th>
                                <th class="column-title">状态 </th>
                                <th class="column-title no-link last"><span class="nobr">行为</span>
                                </th>
                                <th class="bulk-actions" colspan="9">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($royalwatcher as $rw)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" "><img src="{{asset($rw->avatar)}}" alt="" width="20px" height="20px" style="border-radius: 50%"></td>
                                    <td class=" ">{{$rw->royalwatcher}}</td>
                                    <td class=" ">{{config('miscellanea.royal_watcher_rank')[$rw->role]}} </td>
                                    <td class=" ">{{$rw->login_time}} </td>
                                    <td class=" ">{{$rw->ip}}</td>
                                    <td class=" ">{{$rw->browser}}</td>
                                    <td class=" ">{{$rw->phoneinfo}}</td>
                                    <td class=" ">{{$rw->os}}</td>
                                    <td class=" " style="color:
                                    @if($rw->status == 1)
                                            green
                                    @elseif($rw->status == 2)
                                            red
                                    @endif
                                            ">{{config('miscellanea.pony_status')[$rw->status]}}</td>
                                    <td class=" last">
                                        <a onclick="hire({{$rw->rid}})" style="cursor: pointer">激活/</a>
                                        <a onclick="fire({{$rw->rid}})" style="cursor: pointer">锁定</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$royalwatcher->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
        function fire(rid){
            layer.confirm('确定锁定这位管理员吗?', {
                title:'提示！',
                btnAlign: 'c',
                closeBtn: 1,
                btn: ['确定', '取消'] //可以无限个按钮
                ,btn3: function(index, layero){
                }
            }, function(index, layero){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route('celestia_yaf')}}',
                    data:'rid=' + rid,
                    type:'post',
                    success:function (s) {
                        if(s==1){
                            layer.msg('锁定成功');
                            setTimeout(function(){
                                window.location.reload();
                            },1000)
                        }
                    }
                });
            });
        }

        function hire(rid){
            layer.confirm('确定激活这位管理员吗?', {
                title:'提示！',
                btnAlign: 'c',
                closeBtn: 1,
                btn: ['确定', '取消'] //可以无限个按钮
                ,btn3: function(index, layero){
                }
            }, function(index, layero){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route('celestia_yah')}}',
                    data:'rid=' + rid,
                    type:'post',
                    success:function (s) {
                        if(s==1){
                            layer.msg('激活成功');
                            setTimeout(function(){
                                window.location.reload();
                            },1000)
                        }
                    }
                });
            });
        }
@endsection