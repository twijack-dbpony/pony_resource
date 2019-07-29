@extends('structure.equestria_law')
@section('title','429 Too Many Requests')
@section('style',asset('images/429_background.jpg'))
@section('content')
    @notice
        @slot('code') 429 @endslot
        @slot('image') error_400.png @endslot

        @slot('aj') orange @endslot
        @slot('ts') purple @endslot

        @slot('caption') 上一个这样做的是云宝 @endslot
        @slot('subtitle') 但不幸的是，她是主角 @endslot
        恶作剧是有限度的
    @endnotice
@endsection