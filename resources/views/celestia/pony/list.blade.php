@extends('structure.equestria_back')
@section('title',$appName.'-成员列表')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>成员列表 </h2>
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
                <p>以下为 <code>成员</code> 列表</p>
                <div>
                    <form method="post" action="{{route('celestia_pl')}}">
                        {{csrf_field()}}
                        <div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <select class="form-control" name="search">
                                    @foreach(config('miscellanea.pony_search') as $key => $val)
                                        @if($search == $key)
                                            <option value="{{$key}}" selected="selected">{{$val}}</option>
                                        @else
                                            <option value="{{$key}}">{{$val}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <select class="form-control" name="status">
                                    @foreach(config('miscellanea.pony_status') as $key => $val)
                                        @if($status == $key)
                                            <option value="{{$key}}" selected="selected">{{$val}}</option>
                                        @else
                                            <option value="{{$key}}">{{$val}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <input class="form-control" type="text" name="keyword" value="{{$keyword}}">
                            </div>
                            <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
                        </div>
                    </form>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">成员id </th>
                                <th class="column-title">头像 </th>
                                <th class="column-title">用户名 </th>
                                <th class="column-title">昵称 </th>
                                <th class="column-title">ip </th>
                                <th class="column-title">os </th>
                                <th class="column-title">浏览器 </th>
                                <th class="column-title">创建时间 </th>
                                <th class="column-title">状态 </th>
                                <th class="column-title no-link last"><span class="nobr">行为</span>
                                </th>
                                <th class="bulk-actions" colspan="11">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($pony as $p)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" ">{{$p->ponyid}}</td>
                                    <td class=" "><img src="{{$p->avatar}}" alt="" width="20px" height="20px" style="border-radius: 50%"></td>
                                    <td class=" ">{{$p->ponyname}}</td>
                                    <td class=" ">{{$p->nickname}}</td>
                                    <td class=" ">{{$p->last_login_ip}}</td>
                                    <td class=" ">{{$p->last_login_os}}</td>
                                    <td class=" ">{{$p->last_login_browser}}</td>
                                    <td class=" ">{{$p->created_time}}</td>
                                    <td class=" " style="color:
                                    @if($p->status == 1)
                                            green
                                    @elseif($p->status == 2)
                                            red
                                    @endif
                                            ">{{config('miscellanea.pony_status')[$p->status]}}</td>
                                    <td class=" last">
                                        <a onclick="activate({{$p->ponyid}})" style="cursor: pointer">激活</a>/
                                        <a onclick="lock({{$p->ponyid}})" style="cursor: pointer">锁定</a>/
                                        <a style="cursor: pointer" href="{{url('pony_edit/ponyid/'.$p->ponyid)}}">编辑</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$pony->appends('search',$search)
                                ->appends('keyword',$keyword)
                                ->appends('status',$status)
                                ->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
        function activate(ponyid){
            layer.confirm('确定激活这个成员用户吗?', {
                title:'提示！',
                btnAlign: 'c',
                closeBtn: 1,
                btn: ['确定', '取消']
                ,btn3: function(index, layero){
                }
            }, function(index, layero){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route('celestia_pa')}}',
                    data:'ponyid=' + ponyid,
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

        function lock(ponyid){
            layer.confirm('确定锁定这个成员用户吗??', {
                title:'提示！',
                btnAlign: 'c',
                closeBtn: 1,
                btn: ['确定', '取消']
                ,btn3: function(index, layero){
                }
            }, function(index, layero){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:'{{route('celestia_plo')}}',
                    data:'ponyid=' + ponyid,
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
@endsection