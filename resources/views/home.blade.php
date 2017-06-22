@extends('layouts.app')

@section('content')
    @foreach($bookmarks as $bookmark)
        <div class="row">
            <div class="medium-4 columns">
                <div class="bookmark-listing">
                    <h3><a href="">{{$bookmark->title}}</a></h3>
                    <p>{{$bookmark->description}}</p>
                </div>
            </div>
        </div>
    @endforeach
@endsection
