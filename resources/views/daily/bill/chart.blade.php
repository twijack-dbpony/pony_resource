@extends('structure.equestria_back')
@section('title','db日常支出账单概况')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>db日常支出账单概况 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <p>以下为db日常支出 <code>账单概况</code></p>
                    <div>
                        <form id="db-general-search" method="post" action="">
                            <input type="hidden" id="tc_date" value="{!! @$hc['day'] !!}">
                            <input class="form-control hidden-date" type="hidden" name="date" value="{{$date}}">
                            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span class="general-date">{{$date}}</span> <b class="caret"></b>
                            </div>
                            @csrf
                            <div>
                                <span style="float: right;height: 32px" class="btn btn-default general-btn">搜索</span>
                            </div>
                        </form>
                    </div>
                    <div style="width:100%">
                        <div id="container"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr style="background-color: silver;color: black">
                                <th class="column-title">汇总 </th>
                                <th class="column-title">¥{{$chart['sum']}} </th>
                            </tr>
                            <tr class="headings">
                                <th class="column-title">日期 </th>
                                <th class="column-title">金额 </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(@$chart['list'])
                                @foreach($chart['list'] as $c)
                                    <tr class="even pointer">
                                        <td><a href="{{route('d_bcc',$c->day)}}" target="_blank">{{$c->day}}</a> </td>
                                        <td>¥{{$c->bucks}} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$chart['list']->appends(['date' => $date])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.general-btn').click(function () {
            var date = $('.general-date').html();
            $('.hidden-date').val(date);
            $('#db-general-search').submit();
        });

        var date_calendar = $('.hidden-date').val();
        var date_calendar_array = date_calendar.split(' - ');

        var date = $('#tc_date').val();
        date = date.split(',');

        Highcharts.chart('container', {

            title: {
                text: ''
            },

            xAxis: {
                categories: date
            },

            yAxis: {
                title: {
                    text: '点击'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            plotOptions: {
                series: {
                    label: {
                        connectorAllowed: false
                    }
                }
            },

            series: [{
                name: '金额',
                data: [{!! @$hc['bucks'] !!}]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@endsection