@extends('structure.equestria_law')
@section('title','419 Page Expired')
@section('style',asset('images/419_background.jpg'))
@section('content')
    @notice
        @slot('code') 419 @endslot
        @slot('image') error_400.png @endslot

        @slot('ts') purple @endslot
        @slot('aj') orange @endslot

        @slot('caption') 邪茧女王已经被打败了！@endslot
        @slot('subtitle') 没有必要在进行伪装了！@endslot
        幻形灵警告
    @endnotice
@endsection