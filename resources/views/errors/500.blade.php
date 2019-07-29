@extends('structure.equestria_law')
@section('title','500 Internal Server Error')
@section('style',asset('images/500_background.png'))
@section('content')
    @notice
        @slot('code') 500 @endslot
        @slot('image') error_500.png @endslot

        @slot('aj') purple @endslot
        @slot('ts') orange @endslot

        @slot('caption') 暮暮的实验又出事了 @endslot
        @slot('subtitle') 最好通知一下苹果杰克 @endslot
        这不可能!不!
    @endnotice
@endsection