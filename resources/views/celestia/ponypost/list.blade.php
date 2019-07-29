@extends('structure.equestria_back')
@section('title',$appName.'-文章列表')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>文章列表 </h2>
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
                <p>以下为 <code>文章</code> 列表</p>
                <div>
                    <form method="post" action="{{route('celestia_ppl')}}">
                        {{csrf_field()}}
                        <div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select class="form-control" name="search">
                                    @foreach(config('miscellanea.ponypost_search') as $key => $val)
                                        @if($search == $key)
                                            <option value="{{$key}}" selected="selected">{{$val}}</option>
                                        @else
                                            <option value="{{$key}}">{{$val}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select class="form-control" name="type">
                                    @foreach(config('miscellanea.ponypost_type') as $key => $val)
                                        @if($type == $key)
                                            <option value="{{$key}}" selected="selected">{{$val['char']}}</option>
                                        @else
                                            <option value="{{$key}}">{{$val['char']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select class="form-control" name="status">
                                    @foreach(config('miscellanea.ponypost_status') as $key => $val)
                                        @if($status == $key)
                                            <option value="{{$key}}" selected="selected">{{$val}}</option>
                                        @else
                                            <option value="{{$key}}">{{$val}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
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
                                <th class="column-title">文章id </th>
                                <th class="column-title">缩略图 </th>
                                <th class="column-title">文章标题 </th>
                                <th class="column-title">作者 </th>
                                <th class="column-title">类型 </th>
                                <th class="column-title">点击数 </th>
                                <th class="column-title">喜欢数 </th>
                                <th class="column-title">评论数 </th>
                                <th class="column-title">发表时间 </th>
                                <th class="column-title">状态 </th>
                                <th class="column-title no-link last"><span class="nobr">行为</span>
                                </th>
                                <th class="bulk-actions" colspan="11">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($ponypost as $p)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" " style="min-width: 100px">{{$p->postid}}</td>
                                    <td class=" "><img src="{{$p->water_img}}" alt="" width="80px" height=48px"></td>
                                    <td class=" " style="min-width: 100px">{{$p->title}}</td>
                                    <td class=" " style="min-width: 100px">{{$p->nickname}}</td>
                                    <td class=" " style="min-width: 100px">{{config('miscellanea.ponypost_type')[$p->type]['char']}}</td>
                                    <td class=" " style="min-width: 100px">{{$p->click}}</td>
                                    <td class=" " style="min-width: 100px">{{$p->fav}}</td>
                                    <td class=" " style="min-width: 100px">{{$p->comment}}</td>
                                    <td class=" " style="min-width: 100px">{{$p->created_time}}</td>
                                    <td class=" " style="min-width: 100px;color:
                                    @if($p->status == 1)
                                            green
                                    @elseif($p->status == 2)
                                            red
                                    @endif
                                    ">{{config('miscellanea.ponypost_status')[$p->status]}}</td>
                                    <td class=" last" style="min-width: 200px">
                                        <a onclick="activate({{$p->postid}})" style="cursor: pointer">激活</a>/
                                        <a onclick="lock({{$p->postid}})" style="cursor: pointer">锁定</a>/
                                        <a style="cursor: pointer" href="{{url('ponypost_edit/postid/'.$p->postid)}}">编辑</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$ponypost->appends('search',$search)
                                    ->appends('keyword',$keyword)
                                    ->appends('status',$status)
                                    ->appends('type',$type)
                                    ->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
        function activate(postid){
            layer.confirm('确定通过这篇文章吗?', {
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
                    url:'{{route('celestia_ppa')}}',
                    data:'postid=' + postid,
                    type:'post',
                    success:function (s) {
                        if(s==1){
                            layer.msg('通过成功');
                            setTimeout(function(){
                                window.location.reload();
                            },1000)
                        }
                    }
                });
            });
        }

        function lock(postid){
            layer.confirm('确定锁定这篇文章吗??', {
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
                    url:'{{route('celestia_pplo')}}',
                    data:'postid=' + postid,
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