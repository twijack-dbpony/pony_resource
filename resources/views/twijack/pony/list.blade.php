@extends('structure.equestria_front')
@section('title','Ponies!!!')
@section('body')
    <section id="page-breadcrumb">
        <div class="vertical-center sun">
            <div class="container">
                <div class="row">
                    <div class="action">
                        <div class="col-sm-12">
                            <h1 class="title">Ponies!!</h1>
                            <p>Died of cuteness</p>
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
                <ul class="portfolio-filter text-center">
                    <li><a class="btn btn-default active" href="#" data-filter="*">All</a></li>
                    <li><a class="btn btn-default" href="#" data-filter=".stallion">Stallion</a></li>
                    <li><a class="btn btn-default" href="#" data-filter=".mare">Mare</a></li>
                </ul><!--/#portfolio-filter-->

                <div class="portfolio-items">
                    @foreach($pony as $p)
                        <div class="col-xs-6 col-sm-4 col-md-3 portfolio-item {{$p->sex}}">
                            <div class="portfolio-wrapper">
                                <div class="portfolio-single">
                                    <div class="portfolio-thumb">
                                        <img src="{{asset('ponyDisplay/'.$p->thumb)}}" class="img-responsive" alt="" width="50px">
                                    </div>
                                    <div class="portfolio-view">
                                        <ul class="nav nav-pills">
                                            <li><a href="{{asset('ponyDisplay/'.$p->thumb)}}" data-lightbox="example-set"><i class="fa fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="portfolio-info ">
                                    <h2 style="background-color: {{$p->mane}};border-radius: 50px;text-align: center">M</h2>
                                    <h2 style="background-color: {{$p->coat}};border-radius: 50px;text-align: center">C</h2>
                                    <h5 style="text-align: center">{{$p->ponyname}}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="blog-pagination">
                    <ul class="pagination">
                        {{$pony->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection