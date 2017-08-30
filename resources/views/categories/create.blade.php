@extends('layouts.app')

@section('content')
    <form method="POST" action="/categories" class="inline-form">
        {{csrf_field()}}

        <div class="row">
            <div class="column small-12 medium-8 large-6">

                <div class="row">
                    <div class="small-3 columns">
                        <label for="title" class="inline right">Title:</label>
                    </div>

                    <div class="small-9 columns">
                        <input type="text" name="title" placeholder="Enter a title for your category" />
                    </div>
                </div>

                <input type="submit" class="button tiny right" value="Save Category"/>
        </div>
    </form>
@endsection