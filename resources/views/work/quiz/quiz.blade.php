@extends('structure.equestria_back')
@section('title',$appName.'-题库')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pop Quiz </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                @foreach($quiz as $q)
                        <form id="main_question" method="post" action="{{route('q_pqs')}}">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="text-align: center;font-size: 18px">{{$q->question}}</p>
                                    <input type="hidden" id="qid" value="{{$q->qid}}">
                                    <input type="hidden" id="quizType" value="{{$q->type}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>

                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    @foreach(collect(explode(',',$q->choices))->shuffle() as $k => $c)
                                        @if($q->type == 1)
                                            <div class="radio choices">
                                                <label>
                                                    <input type="radio" class="flat" name="choice" value="{{$c}}"> {{$c}}
                                                </label>
                                            </div>
                                        @else
                                            <div class="checkbox choices">
                                                <label>
                                                    <input type="checkbox" class="flat" name="choice[]" value="{{$c}}"> {{$c}}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group" id="solution">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" style="text-align: center">
                                    <span class="btn btn-success solution">提交</span>
                                </div>
                            </div>
                        </form>
                @endforeach
                    <div class="form-group yesSection" style="display: none">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <h1 style="color:limegreen">Yes</h1>
                        </div>
                    </div>
                    <div class="form-group noSection" style="display: none">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <h1 style="color:red">No</h1>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group shadowSection" style="display: none">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            正确次数：<span style="color:limegreen" id="rightCount">{{ $q->quiz->rightCount }}</span>&nbsp;&nbsp;
                            错误次数：<span style="color:red" id="wrongCount">{{ $q->quiz->wrongCount }}</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group shadowSection" style="display: none">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label"></label>
                        <div class="col-md-9 col-sm-9 col-xs-12" style="color:purple">
                            <span style="font-size:24px;color:orange">解析：</span>{!! $q->quiz->analysis !!}
                        </div>
                    </div>
                </div>
                <div class="pagination_box">
                    {{$quiz->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.solution').click(function () {
            var type = $('#quizType').val();
            if(type == 1){
                var choices = $('input[name=choice]:checked').val();
            }else{
                var choices = $(".x_content input:checkbox:checked").map(function(){
                    return $(this).val();
                }).toArray().join(',');
            }

            var id = $('#qid').val();
            $.ajax({
                url:'{{route('q_pqs')}}',
                type:'get',
                data:{choice:choices,id:id,type:type},
                success:function (s) {
                    if(s == 'W'){
                        $('.noSection').show();
                        $('#wrongCount').html(parseInt($('#wrongCount').html()) + 1);
                    }else{
                        $('.yesSection').show();
                        $('#rightCount').html(parseInt($('#rightCount').html()) + 1);
                    }
                    $('.shadowSection').show();
                    $('#solution').hide();
                }
            })
        })
    </script>
@endsection