@extends('structure.equestria_back')
@section('title','众筹地域统计')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>众筹地域统计 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <p>以下为众筹 <code>地域统计</code></p>
                    <div style="width:100%">
                        <div id="region"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">省名称 </th>
                                <th class="column-title">数量 </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($region['table'])
                                @foreach($region['table'] as $r)
                                    <tr class="even pointer">
                                        <td>{{$r->province}}</td>
                                        <td>{{$r->count}} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$region['table']->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        Highcharts.chart('region', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '众筹地域统计'
            },
            tooltip: {
                pointFormat: '<b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                colorByPoint: true,
                data: [{!! $region['pie'] !!}]
            }]
        });
    </script>
@endsection