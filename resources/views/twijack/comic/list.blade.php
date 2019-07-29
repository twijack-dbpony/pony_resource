@extends('structure.equestria_front')
@section('title','漫画列表')
@section('body')
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
            <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Ponies!!</h1>
                            <p>官方漫画</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#action-->

    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="portfolio-items">
                    @foreach($comic as $c)
                        @php
                            $preview = str_replace(' ','_',$c->title);
                        @endphp
                        <div class="col-xs-6 col-sm-4 col-md-3 portfolio-item">
                            <div class="portfolio-wrapper">
                                <div class="portfolio-single">
                                    <div class="portfolio-thumb">
                                        <img src="{{asset('Transcend/PonyComicsCover/'.$preview)}}.png" class="img-responsive" alt="" width="50px">
                                    </div>
                                    <div class="portfolio-view">
                                        <ul class="nav nav-pills">
                                            <li><a href="{{asset('Transcend/PonyComicsCover/'.$preview)}}.png" data-lightbox="example-set"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="portfolio-info">
                                    <h2 style="cursor:pointer;font-style: italic;font-weight: bold; text-overflow: ellipsis;white-space: nowrap;overflow: hidden;" onclick="window.location.href='{{url('pony_comic_self/cid').'/'.$c->id}}'" title="{{$c->title}}">{{$c->title}}</h2>
                                    <h3 class="btn btn-primary">{{$c->type}}</h3>
                                    <h4 style="font-style: oblique;color: #2a85a0">clicks: {{$c->click}}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="blog-pagination">
                <ul class="pagination">
                    {{$comic->links()}}
                </ul>
            </div>
        </div>
    </section>
@endsection