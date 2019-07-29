@extends('structure.equestria_law')
@section('title','503 Service Unavailable')
@section('style',asset('images/503_background.jpg'))
@section('content')
    @notice
        @slot('code') 503 @endslot
        @slot('image') error_500.png @endslot

        @slot('aj') purple @endslot
        @slot('ts') orange @endslot

        @slot('caption') 小马国正遭受怪物的日常袭击 @endslot
        @slot('subtitle') 不用担心，她们很快就好 @endslot
        M6正在拯救马国
    @endnotice
@endsection