@extends('structure.equestria_back')
@section('title',$appName.'-手游小马列表')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>手游小马列表 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @tip @endtip
                <div class="x_content">

                    <p>以下为{{$appName}} <code>手游小马</code> 列表</p>
                    <div>
                        <form method="post" action="{{route('gp_d')}}">
                            @csrf
                            <div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input class="form-control" type="text" name="name" placeholder="name" value="{{$name}}">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="sex" class="form-control">
                                        @foreach(config('pony.sex') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($sex) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="race" class="form-control">
                                        @foreach(config('pony.race') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($race) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="location" class="form-control">
                                        @foreach(config('pony.location') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($location) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-12">
                                    <select name="own" class="form-control">
                                        @foreach(config('pony.own') as $k => $v)
                                            <option value="{{$k}}"
                                                    @if(($own) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
                                <span class="btn btn-primary"><a href="{{route('gp_op')}}" style="color: whitesmoke">新增手游小马</a></span>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title" colspan="4">Ponies Count </th>
                                <th class="column-title" colspan="10" style="color: violet">{{$count}} </th>
                            </tr>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">id </th>
                                <th class="column-title">小马名称 </th>
                                <th class="column-title">缩略图 </th>
                                <th class="column-title">性别 </th>
                                <th class="column-title">种族 </th>
                                <th class="column-title">地区 </th>
                                <th class="column-title">是否拥有 </th>
                                <th class="column-title">支付方式 </th>
                                <th class="column-title">支付数量 </th>
                                <th class="column-title">星级 </th>
                                <th class="column-title no-link last"><span class="nobr">行为</span>
                                </th>
                                <th class="bulk-actions" colspan="9">
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
                                    <td class=" ">{{$p->id}}</td>
                                    <td class=" ">{{$p->name}}</td>
                                    <td class=" ">
                                        <img src="{{asset('thumb/'.$p->thumb)}}" width="50px" style="border-radius: 50%" alt="">
                                    </td>
                                    <td class=" ">{{config('pony.sex')[$p->sex]}}</td>
                                    <td class=" ">{{config('pony.race')[$p->race]}}</td>
                                    <td class=" ">{{config('pony.location')[$p->location]}}</td>
                                    <td class=" ">{{config('pony.own')[$p->own]}}</td>
                                    <td class=" ">
                                        @if($p->own == 1)
                                            /
                                        @else
                                            {{config('pony.type')[$p->price_type]}}
                                        @endif
                                    </td>
                                    <td class=" ">
                                        @if($p->own == 1)
                                            0
                                        @else
                                            {{$p->price}}
                                        @endif</td>
                                    <td class=" ">{{$p->star}}</td>
                                    <td class=" last">
                                        <a href="{{route('gp_op').'/'.$p->id.'?m=e'}}" style="cursor: pointer">编辑</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$pony->appends([
                            'name' => $name,
                            'sex' => $sex,
                            'race' => $race,
                            'location' => $location,
                            'own' => $own
                        ])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection