@extends('layouts.app')

@section('content')
    <h2>{{$category->title}}</h2>

    <div class="row">
        @foreach($bookmarks as $key => $bookmark)
            @if($key % 3 == 0)
                <div class="clearfix"></div>
            @endif

            <div class="medium-4 columns">
                <div class="bookmark-listing">
                    <h3><a href="{{url('bookmarks/'.$bookmark->id)}}">{{$bookmark->title}}</a></h3>
                    <p>{{$bookmark->description}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
