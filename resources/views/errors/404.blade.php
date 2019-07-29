@extends('structure.equestria_law')
@section('title','404 Page Not Found')
@section('style',asset('images/404_background.png'))
@section('content')
    @notice
        @slot('code') 404 @endslot
        @slot('image') error_400.png @endslot

        @slot('ts') purple @endslot
        @slot('aj') orange @endslot

        @slot('caption') 你似乎想去除马国外的地方 @endslot
        @slot('subtitle') 你最好咨询无序，他通常知道怎么去！@endslot
        正在远离小马国
    @endnotice
@endsection