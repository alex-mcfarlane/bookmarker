@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="small-6 small-centered columns">
            <div class="bookmark bookmark-container detailed">
                <h2><a href="{{$bookmark->url}}" target="_blank">{{$bookmark->title}}</a></h2>

                <div class="tagline">
                    <p class="flex">Bookmarked from <a href="{{$bookmark->url}}" target="_blank">{{$bookmark->getHostName()}}</a></p>
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
                            @if($bookmark->read)
                                <form method="POST" action="{{url('bookmarks/'.$bookmark->id)}}">
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}

                                    <input type="hidden" name="read" value="0"/>

                                    <button type="submit" title="Mark as Open">
                                        <i class="fa fa-envelope"></i>
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{url('bookmarks/'.$bookmark->id)}}">
                                    {{csrf_field()}}
                                    {{ method_field('Patch') }}

                                    <input type="hidden" name="read" value="1"/>

                                    <button type="submit" title="Archive">
                                        <i class="fa fa-envelope-open"></i>
                                    </button>
                                </form>
                            @endif

                        </li>
                    </ul>
                </div>
                <div class="clearfix">

                </div>
            </div>
        </div>
    </div>
@endsection
