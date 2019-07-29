@extends('structure.equestria_back')
@section('title','众筹回报物品列表')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>众筹回报物品列表 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @tip @endtip
                <div class="x_content">

                    <p>以下为众筹 <code>回报物品</code> 列表</p>
                    <div>
                        <form method="post" action="{{route('pcd_d')}}">
                            @csrf
                            <div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="level" class="form-control">
                                        @foreach(config('crowd.level') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($level) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input class="form-control" type="text" name="keyword" placeholder="众筹物品名称" value="{{$keyword}}">
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
                                <span class="btn btn-primary"><a href="{{route('pcd_op')}}" style="color: whitesmoke">新增</a></span>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive" id="crowd_layer">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">物品名称 </th>
                                <th class="column-title">缩略图 </th>
                                <th class="column-title">众筹等级 </th>
                                {{--<th class="column-title no-link last" style="min-width: 100px"><span class="nobr">操作</span>--}}
                                <th class="bulk-actions" colspan="9">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($crowd as $c)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" ">{{$c->name}}</td>
                                    <td class=" ">
                                        <img src="{{asset('crowd/'.$c->thumb)}}" layer-src="{{asset('crowd/'.$c->thumb)}}" width="30px" alt="">
                                    </td>
                                    <td class="level_id" cname="{{$c->name}}"></td>
                                    {{--<td class=" last">--}}
                                        {{--<a href="{{route('pcd_op').'/'.$c->id.'?m=e'}}">编辑</a>/--}}
                                        {{--<a href="javascript:;" onclick="trash('{{$c->id}}')">删除</a>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$crowd->appends(['keyword' => $keyword, 'level' => $level])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        layer.photos({
            photos: '#crowd_layer',
            anim: 5
        });

        $(function () {
            $('.level_id').each(function () {
                var node = $(this);

                var cname = node.attr('cname');

                $.get("{{route('pcd_ll')}}",
                    {
                        'name':cname
                    }, function(data) {
                        node.text(data + '档位');
                    });
            });
        });

        function trash(id){
            layer.confirm('确定删除吗?', {
                title:'提示！',
                btnAlign: 'c',
                closeBtn: 1,
                btn: ['确定', '取消'] //可以无限个按钮
                ,btn3: function(index, layero){
                }
            }, function(index, layero){
                $.ajax({
                    url:'{{route('pcd_t')}}',
                    data:{id:id},
                    type:'post',
                    success:function (s) {
                        if(s==1){
                            layer.msg('删除成功');
                            setTimeout(function(){
                                window.location.reload();
                            },1000)
                        }
                    }
                });
            });
        }
    </script>
@endsection