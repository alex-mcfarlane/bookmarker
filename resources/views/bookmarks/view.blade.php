@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="small-6 small-centered columns">
            <div class="bookmark-container">
                <h2><a href="{{$bookmark->url}}">{{$bookmark->title}}</a></h2>

                <p>{{$bookmark->description}}</p>
            </div>
        </div>
    </div>
@endsection
