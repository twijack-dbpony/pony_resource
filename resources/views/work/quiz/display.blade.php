@extends('structure.equestria_back')
@section('title',$appName.'-专转本题库')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>专转本题库 </h2>
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

                    <p>以下为{{$appName}} <code>专转本题库</code> 列表</p>
                    <div>
                        <form method="post" action="{{route('q_psd')}}">
                            @csrf
                            <div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <select name="type" class="form-control">
                                        @foreach(config('constants.quizType') as $k => $v)
                                            <option value="{{$k}}"
                                                @if($k == $type)
                                                    selected
                                                @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <select name="subject" class="form-control">
                                        @foreach(config('constants.quizSubject') as $k => $v)
                                            <option value="{{$k}}"
                                                @if($k == $subject)
                                                        selected
                                                @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
                                <span class="btn btn-primary"><a href="{{route('q_pso')}}" style="color: whitesmoke">新增专转本题库</a></span>
                                <span class="btn btn-warning"><a href="{{route('q_paq')}}" style="color: whitesmoke">开始测试</a></span>
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
                                <th class="column-title">问题 </th>
                                <th class="column-title" style="min-width: 60px">类型 </th>
                                <th class="column-title" style="min-width: 160px">科目 </th>
                                <th class="column-title" style="min-width: 160px">创建时间 </th>
                                {{--<th class="column-title no-link last" style="min-width: 60px"><span class="nobr">行为</span>--}}
                                {{--</th>--}}
                                <th class="bulk-actions" colspan="9">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($quiz as $q)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                    </td>
                                    <td class=" ">{{$q->id}}</td>
                                    <td class=" ">{{$q->question}}</td>
                                    <td class=" ">{{config('constants.quizType')[$q->type]}}</td>
                                    <td class=" ">{{config('constants.quizSubject')[$q->subject]}}</td>
                                    <td class=" ">{{$q->created_at}}</td>
                                    {{--<td class=" last">--}}
{{--                                        <a href="{{route('w_pso').'/'.$s->id.'?m=e'}}" style="cursor: pointer">编辑</a>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$quiz->appends(['type' => $type, 'subject' => $subject])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection