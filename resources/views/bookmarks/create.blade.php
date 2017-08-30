@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="column small-12 medium-8 large-6">
            <form method="POST" action="/bookmarks" class="inline-form">

                <input type="hidden" value="{{csrf_token()}}"/>

                <div class="row">
                    <div class="column small-3">
                        <label for="url" class="right inline">Url:</label>
                    </div>

                    <div class="column small-9">
                        <input type="text" name="url" id="url" placeholder="Enter the URL for the web page"/>
                    </div>
                </div>

                <div class="row">
                    <div class="column small-3">
                        <label for="title" class="right inline">Title:</label>
                    </div>

                    <div class="column small-9">
                        <input type="text" name="title" id="title" placeholder="Enter a title"/>
                    </div>
                </div>

                <div class="row">
                    <div class="column small-3">
                        <label for="description" class="right inline">Description:</label>
                    </div>

                    <div class="column small-9">
                        <input type="text" name="description" id="description" placeholder="Describe the page you are bookmarking"/>
                    </div>
                </div>

                <div class="row">
                    <div class="column small-12">
                        <input type="submit" class="button tiny right" value="Save Bookmark"/>
                    </div>
                </div>

            </form>

            @if($errors->count()>0)
                <div class="alert-box">
                    @foreach($errors->messages() as $error)
                        <p>{{$error[0]}}</p>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
@endsection