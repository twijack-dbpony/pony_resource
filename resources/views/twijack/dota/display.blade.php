@extends('structure.equestria_back')
@section('title',$appName.'-dota小马列表')
@section('body')
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>dota小马列表 </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                @tip @endtip
                <div class="x_content">

                    <p>以下为{{$appName}} <code>dota小马</code> 列表</p>

                    <div>
                        <form method="post" action="{{route('gp_dd')}}">
                            @csrf
                            <div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input class="form-control" type="text" name="search" placeholder="name" value="{{$search}}">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="role" class="form-control">
                                        @foreach(config('pony.role') as $v)
                                            <option value="{{$v}}"
                                                    @if(($role) == $v)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select name="attribute" class="form-control">
                                        @foreach(config('pony.attribute') as $v)
                                            <option value="{{$v}}"
                                                    @if(($attribute) == $v)
                                                        selected
                                                    @endif
                                            >{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" style="margin-left: 10px" class="btn btn-default">搜索</button>
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
                                <th class="column-title">pony </th>
                                <th class="column-title">title </th>
                                <th class="column-title">attribute </th>
                                <th class="column-title">role </th>
                                <th class="bulk-actions" colspan="9">
                                    <a class="antoo" style="color:#fff; font-weight:500;">批处理 ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($dota as $d)
                                <tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="flat" name="table_records">
                                        <input type="hidden" id="{{$d->id}}" value="{{$d->lore}}">
                                    </td>
                                    <td class=" ">{{$d->id}}</td>
                                    <td class=" " style="cursor: pointer" onclick='lore("{{$d->id}}","{{$d->pony}}:{{$d->title}} Lore","{{asset('Transcend/ponyDotaCards/'.$d->avatar)}}")'>{{$d->pony}}</td>
                                    <td class=" ">{{$d->title}}</td>
                                    @php
                                        if($role != 'all roles'){
                                            $role_list = explode(', ',$d->role);
                                            $index = array_search($role,$role_list);
                                            $role_list[$index] = '<font style="color:red">'.$role_list[$index].'</font>';
                                            $role_list = implode(', ',$role_list);
                                        }
                                    @endphp
                                    <td class=" ">{{$d->attribute}}</td>
                                    <td class=" ">{!! @$role_list ?? $d->role !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination_box">
                        {{$dota->appends(['search' => $search, 'attribute' => $attribute, 'role' => $role])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function lore(id,title,avatar) {
            var lore = $('#' + id).val();
            layer.open({
                title:title,
                area:['80%','500px'],
                content:'<div><img src="' + avatar + '" style="border-radius:10%" width="240px" align="left" hspace="10" vspace="3" alt=""></div><div>' + lore + '</div>',
            });
        }
    </script>
@endsection