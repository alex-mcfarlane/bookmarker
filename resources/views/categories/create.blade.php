@extends('layouts.app')

@section('content')

    @if(count($errors->all()) > 0)
        <div class="row">
            <div class="medium-6 column">
                <div class="alert-box alert">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="/categories" class="inline-form" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="row">
            <div class="column small-12 medium-8 large-6">

                <div class="row">
                    <div class="small-3 columns">
                        <label for="title" class="inline right">* Title:</label>
                    </div>

                    <div class="small-9 columns">
                        <input type="text" name="title" placeholder="Enter a title for your category" />
                    </div>
                </div>

                <div class="row">
                    <div class="small-3 columns">
                        <label for="image" class="inline right">* Attach an image for this category:</label>
                    </div>

                    <div class="small-9 columns">
                        <input type="file" id="image" name="image" placeholder="Attach a background image" />
                    </div>
                </div>

                <input type="submit" class="button tiny right" value="Save Category"/>
        </div>
    </form>
@endsection