@extends('layouts.app')

@section('content')
    <section class="search-filter">
        <form method="GET" action="{{url('/home')}}">
            <div class="row">

                <div class="medium-3 columns">

                    <div class="row collapse prefix-radius">
                        <div class="small-3 columns">
                            <span class="prefix">Start</span>
                        </div>
                        <div class="small-9 columns">
                            <input type="date" name="started" value="{{ app('request')->input('started') }}">
                        </div>
                    </div>

                </div>

                <div class="medium-3 columns">

                    <div class="row collapse prefix-radius">
                        <div class="small-3 columns">
                            <span class="prefix">End</span>
                        </div>
                        <div class="small-9 columns">
                            <input type="date" name="ended" value="{{ app('request')->input('ended') }}">
                        </div>
                    </div>

                </div>

                <div class="medium-3 columns">
                    <input type="submit" class="button success small" value="Filter"/>
                </div>

            </div>
        </form>
    </section>

    @if($categories->count() > 0)
        <div class="row">
            <div class="medium-6 medium-centered columns">
                @foreach($categories as $key => $category)
                    @if($key % 3 == 0)
                        <div class="clearfix"></div>
                    @endif

                    <div class="medium-3 columns">
                        @include('categories.listing', ['category' => $category])
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="row">
        @if($bookmarks->count() > 0)
            @foreach($bookmarks as $key => $bookmark)
                @if($key % 3 == 0)
                        <div class="clearfix"></div>
                @endif

                <div class="medium-4 columns">
                    @include('bookmarks.listing', ['bookmark' => $bookmark])
                </div>
            @endforeach
        @else
            <div class="medium-6 medium-centered column">
                <div class="panel callout radius text-center">
                    <p>Welcome to Bookmarker! Quickly and easily create references to resources on the Web. Found an article
                    on a public computer but do not have time to read it? Bookmark it! And read it at home later.</p>
                    <a href="{{url('bookmarks/create')}}" class="button success radius">Create a Bookmark</a>
                </div>
            </div>
        @endif
    </div>

@endsection
