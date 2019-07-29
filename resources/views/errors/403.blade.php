@extends('structure.equestria_law')
@section('title','403 Forbidden')
@section('style',asset('images/403_background.jpg'))
@section('content')
    @notice
        @slot('code') 403 @endslot
        @slot('image') error_400.png @endslot

        @slot('ts') purple @endslot
        @slot('aj') orange @endslot

        @slot('caption') 如果你想通过这种方式去人类世界的话 @endslot
        @slot('subtitle') 你要么是人类，要么就是大师姐 @endslot
        前方中心城图书馆禁区
    @endnotice
@endsection