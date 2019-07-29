@extends('structure.equestria_back')
@section('title',$crowd_type.'众筹列表')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{$crowd_type}}众筹列表 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @tip @endtip
                <div class="x_content">

                    <p>以下为 <code>{{$crowd_type}}众筹</code> 列表</p>
                    <div>
                        <form method="post" action="{{route('pc_d')}}">
                            @csrf
                            <div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="level" class="form-control">
                                        @foreach($crowd_level as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($level) == $k)
                                                    selected
                                                    @endif
                                            >{{$v}}档位</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="search" class="form-control">
                                        @foreach(config('crowd.search') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($search) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input class="form-control" type="text" name="keyword" placeholder="关键字" value="{{$keyword}}">
                                    <input class="form-control" type="hidden" name="type" value="{{$type}}">
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
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
                                <th class="column-title" style="min-width: 60px">id </th>
                                <th class="column-title" style="min-width: 100px">摩点订单id </th>
                                <th class="column-title" style="min-width: 200px">摩点名称 </th>
                                <th class="column-title" style="min-width: 100px">摩点id </th>
                                <th class="column-title" style="min-width: 100px">手机 </th>
                                <th class="column-title" style="min-width: 150px">收件人 </th>
                                <th class="column-title" style="min-width: 80px">收件地址 </th>
                                <th class="column-title" style="min-width: 100px">档位 </th>
                                <th class="column-title" style="min-width: 60px">数量 </th>
                                <th class="column-title" style="min-width: 60px">金额 </th>
                                <th class="column-title" style="min-width: 100px">状态 </th>
                                <th class="column-title" style="min-width: 200px">支付时间 </th>
                                <th class="column-title" style="min-width: 100px">操作 </th>
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
                                    <td class=" ">{{$c->id}}</td>
                                    <td class=" ">{{$c->modian_order_id}}</td>
                                    <td class=" ">{!! $c->nickname ?? '无' !!}</td>
                                    <td class=" ">{{$c->uid}}</td>
                                    <td class=" ">{{$c->phone}}</td>
                                    <td class=" ">{{$c->name}}</td>
                                    <td class=" " onclick="prompt('收件地址','{{$c->address}}')" style="cursor: pointer">查看详情</td>
                                    <td class=" ">{{$crowd_level[$c->level]}}档位</td>
                                    <td class=" ">{{$c->number}}</td>
                                    <td class=" ">¥{{$c->bucks}}</td>
                                    <td class=" " style="cursor: pointer;color: {{config('crowd.status')[$c->status]['color']}} "
                                    @if($c->status == 3)
                                        onclick="prompt('收取具体情况','{{$c->comment}}')"
                                    @endif
                                    >{{config('crowd.status')[$c->status]['string']}}</td>
                                    <td class=" ">{{$c->paid_at}}</td>
                                    <td class=" ">
                                        @if($c->status != 2)
                                            <a href="javascript:;" onclick="response('{{$c->id}}')">收取情况</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$crowd->appends([
                            'keyword' => $keyword,
                            'search' => $search,
                            'type' => $type,
                            'level' => $level
                        ])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function prompt(title,content){
            layer.open({
                title: title,
                content: content
            });
        }

        function response(id){
            layer.confirm("<div class=\"col-sm-12\">\n" +
                "        <div>收取情况</div>\n" +
                "        <select class='crowd_status form-control'><option value='2'>已收取</option><option value='3'>未完全收取</option></select>\n" +
                "        <div>未收取物件详情</div>\n" +
                "        <input type=\"text\" class=\"form-control crowd_comment\" name=\"comment\" value=\"\">\n" +
                "    </div>", {icon: 1, title: '收取情况'}, function (index) {

                var status = $('.crowd_status').val();
                var comment = $('.crowd_comment').val();

                $.ajax({
                    url: '{{route('pc_r')}}',
                    type: 'post',
                    data: {id:id,status:status,comment:comment},
                    success: function (s) {
                        if(s == 1){
                            layer.msg('操作成功');
                            setTimeout(function(){
                                window.location.reload();
                            },1000)
                        }
                    }
                })
            });
        }
    </script>
@endsection('script')