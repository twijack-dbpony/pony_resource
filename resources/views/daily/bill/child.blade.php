@extends('structure.equestria_back')
@section('title','db日常支出账单详情')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>db日常支出账单详情 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <p>以下为db日常支出 <code>账单详情</code></p>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title" style="min-width: 150px">日期 </th>
                                <th class="column-title">金额 </th>
                                <th class="column-title">文本补充 </th>
                                <th class="column-title" style="min-width: 100px">支出分类 </th>
                                <th class="column-title" style="min-width: 150px">具体时间 </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($bill)
                                @foreach($bill as $b)
                                    <tr class="even pointer">
                                        <td>{{$b->day}} </td>
                                        <td>¥{{$b->bucks}} </td>
                                        <td>{{$b->consumeText}} </td>
                                        <td>{{config('constants.pay')[$b->categoryP]}} </td>
                                        <td>{{$b->created_at}} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection