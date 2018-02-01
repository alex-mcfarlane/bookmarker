@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="large-6 small-centered columns">
            <div class="bookmark bookmark-container detailed">

                <div class="title">
                    <h2><a href="{{$bookmark->url}}" target="_blank">{{$bookmark->title}}</a></h2>
                    @if($bookmark->read)
                        <span class="alert-box alert">Archived!</span>
                    @endif
                </div>

                </span>

                <div class="tagline">
                    <span class="fa fa-user"></span>
                    <p class="flex">
                        Bookmarked by {{$bookmark->user->name}} from <a href="{{$bookmark->url}}" class="link" target="_blank">{{$bookmark->getHostName()}}</a>
                    </p>
                    <a href="{{$bookmark->url}}" class="button tiny" target="_blank">Read More!</a>
                </div>

                <p>{{$bookmark->description}}</p>

                @if(Auth::id() == $bookmark->user->id)
                    <div class="actions-container">
                        <ul class="menu">
                            <li>
                                <a href="{{url('bookmarks/'.$bookmark->id.'/edit')}}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{url('bookmarks/'.$bookmark->id)}}">
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}

                                    @if($bookmark->read)
                                        <input type="hidden" name="read" value="0"/>

                                        <button type="submit" title="Mark as Open">
                                            <i class="fa fa-envelope"></i>
                                        </button>
                                    @else
                                        <input type="hidden" name="read" value="1"/>

                                        <button type="submit" title="Archive">
                                            <i class="fa fa-envelope-open"></i>
                                        </button>
                                    @endif
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix">

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
