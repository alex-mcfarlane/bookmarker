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
                    <ul class="menu">
                        <li>
                            <a href="{{url('bookmarks/'.$bookmark->id.'/edit')}}">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{url('bookmarks/'.$bookmark->id.'/archive')}}">
                                {{csrf_field()}}
                                {{ method_field('PUT') }}
                                <button type="submit">
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>

                        </li>
                    </ul>
                </div>
                <div class="clearfix">

                </div>
            </div>
        </div>
    </div>
@endsection
