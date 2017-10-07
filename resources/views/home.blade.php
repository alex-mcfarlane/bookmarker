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
