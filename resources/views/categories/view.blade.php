@extends('layouts.app')

@section('content')
    <h2>{{$category->title}}</h2>

    <div class="row">
        @foreach($bookmarks as $key => $bookmark)
            @if($key % 3 == 0)
                <div class="clearfix"></div>
            @endif

            <div class="medium-4 columns">
                @include('bookmarks.listing', ['bookmark' => $bookmark])
            </div>
        @endforeach
    </div>
@endsection
