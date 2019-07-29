@extends('structure.equestria_law')
@section('title','401 Unauthorized')
@section('style',asset('images/401_background.jpg'))
@section('content')
    @notice
        @slot('code') 401 @endslot
        @slot('image') error_400.png @endslot

        @slot('ts') purple @endslot
        @slot('aj') orange @endslot

        @slot('caption') 没错，你在小马国干什么都可以 @endslot
        @slot('subtitle') 只要是公主允许的就行 @endslot
        你有大公主的许可吗
    @endnotice
@endsection