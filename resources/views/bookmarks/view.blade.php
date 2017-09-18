@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="small-6 small-centered columns">
            <div class="bookmark bookmark-container">
                <h2><a href="{{$bookmark->url}}" target="_blank">{{$bookmark->title}}</a></h2>

                <div class="tagline">
                    <p class="flex">Bookmarked from <a href="{{$bookmark->url}}" target="_blank">{{$bookmark->url}}</a></p>
                    <a href="{{$bookmark->url}}" class="button tiny" target="_blank">Read More!</a>
                </div>

                <p>{{$bookmark->description}}</p>

                <div class="actions-container">
                    <a href="{{url('bookmarks/'.$bookmark->id.'/edit')}}">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </div>
                <div class="clearfix">

                </div>
            </div>
        </div>
    </div>
@endsection
