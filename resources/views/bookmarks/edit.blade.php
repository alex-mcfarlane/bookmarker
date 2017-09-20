@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="column small-12 medium-8 large-6">

            @if($errors->count()>0)
                <div class="alert-box">
                    @foreach($errors->messages() as $error)
                        <p>{{$error[0]}}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{  url('bookmarks/'.$bookmark->id) }}" class="inline-form">

                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="row">
                    <div class="column small-3">
                        <label for="url" class="right inline">Url:</label>
                    </div>

                    <div class="column small-9">
                        <input type="text" name="url" id="url" value="{{ old('url') ? old('url') : $bookmark->url}}"/>
                    </div>
                </div>

                <div class="row">
                    <div class="column small-3">
                        <label for="title" class="right inline">Title:</label>
                    </div>

                    <div class="column small-9">
                        <input type="text" name="title" id="title" value="{{ old('title') ? old('title') : $bookmark->title}}">
                    </div>
                </div>

                <div class="row">
                    <div class="column small-3">
                        <label for="description" class="right inline">Description:</label>
                    </div>

                    <div class="column small-9">
                        <input type="text" name="description" id="description" value="{{ old('description') ? old('description') : $bookmark->description}}"/>
                    </div>
                </div>

                <div class="row">
                    <div class="column small-3">
                        <label for="categories" class="right inline">Categories:</label>
                    </div>

                    <div class="column small-9">
                        <select name="categories[]" id="categories" multiple>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{$bookmark->categories->contains($category) ? 'selected' : ''}}>
                                    {{$category->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="column small-12">
                        <input type="submit" class="button tiny right" value="Update Bookmark"/>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection