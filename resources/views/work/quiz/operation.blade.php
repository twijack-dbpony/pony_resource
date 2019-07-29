@extends('structure.equestria_back')
@section('title',$appName.'-'.$text.'专转本题库')
@section('body')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$text}}专转本题库</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @alert @endalert
                    <div class="x_content">
                        <br />
                        <form id="royalwatcher_add" data-parsley-validate class="form-horizontal form-label-left" action="{{route('q_spo')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">问题
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="question" value="{{old('question') ? : @$quiz['question']}}">
                                    @if(request()->get('m') == 'e')
                                        <input type="hidden" class="form-control col-md-7 col-xs-12" name="id" value="{{$id}}">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">科目
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="subject" class="form-control">
                                        @foreach(config('constants.quizSubject') as $k => $v)
                                            @if($k == 'all')
                                                @continue
                                            @endif
                                            <option value="{{$k}}"
                                                    @if((old('subject') ? : @$quiz['subject']) == $k)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">题目类型</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="type" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-danger">
                                            <input type="radio" class="flat" name="type" value="1"
                                                   @if((old('type') ? : @$quiz['type']) == 1 || !(old('type') ? : @$quiz['type']))
                                                        checked
                                                   @endif
                                            > &nbsp; 单选 &nbsp;
                                        </label>
                                        <label class="btn btn-warning">
                                            <input type="radio" class="flat" name="type" value="2"
                                                   @if((old('type') ? : @$quiz['type']) == 2)
                                                        checked
                                                   @endif
                                            > &nbsp; 多选 &nbsp;
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @php
                                $choices = old('choices') ?? @$quiz['choices']
                            @endphp
                            @if($choices)
                                @for($f = 0; $f < count($choices); $f ++)
                                    @if(!$choices[$f])
                                        @continue
                                    @endif
                                    @choices
                                        @slot('choice') {{$choices[$f]}} @endslot
                                    @endchoices
                                @endfor
                            @else
                                @choices @endchoices
                            @endif
                            <div class="form-group" id="choices_button">
                                <label class="control-label col-md-6 col-sm-6 col-xs-12" style="text-decoration: underline;cursor: pointer;" id="choices">
                                    新增选项
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">答案
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="correct" placeholder="such as:A" value="{{old('consumeText') ? : @$bill['consumeText']}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">解析
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="analysis" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-success royalwatcher_add">{{$text}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#choices').click(function () {
            $('#choices_button').prepend('@choices @endchoices');
        })
    </script>
@endsection


