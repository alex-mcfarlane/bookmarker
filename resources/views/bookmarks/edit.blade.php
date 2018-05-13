@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="column small-12 medium-10 large-8">

            <form method="POST" action="{{  url('bookmarks/'.$bookmark->id) }}" class="inline-form">

                {{ csrf_field() }}

                {{ method_field('PUT') }}

                <div class="row">
                    <div class="column medium-8">
                        <fieldset>
                        <legend>Bookmark Details</legend>
                            <div {{ $errors->has('url') ? "class=error" : ""}}>
                                <label for="url">Url: <span class="required">Required</span>
                                    <input type="text" name="url" id="url" value="{{ old('url') ? old('url') : $bookmark->url}}"/>
                                </label>

                                @if($errors->has('url'))
                                    <small class="error">{{$errors->get('url')[0]}}</small>
                                @endif
                            </div>

                            <div {{ $errors->has('title') ? "class=error" : ""}}>
                                <label for="title">Title: <span class="required">Required</span>
                                    <input type="text" name="title" id="title" value="{{ old('title') ? old('title') : $bookmark->title}}">
                                </label>

                                @if($errors->has('title'))
                                    <small class="error">{{$errors->get('title')[0]}}</small>
                                @endif
                            </div>

                            <div {{ $errors->has('description') ? "class=error" : ""}}>
                                <label for="description">Description:
                                    <input type="text" name="description" id="description" value="{{ old('description') ? old('description') : $bookmark->description}}"/>
                                </label>

                                @if($errors->has('description'))
                                    <small class="error">{{$errors->get('description')[0]}}</small>
                                @endif
                            </div>
                        </fieldset>
                    </div>

                    <div class="column medium-4">
                        <fieldset>
                            <legend>Meta Info</legend>
                            <div>
                                <label for="categories">Categories:
                                    <select name="categories[]" id="categories" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$bookmark->categories->contains($category) ? 'selected' : ''}}>
                                                {{$category->title}}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div {{$errors->has('visibility_id') ? "class=error" : ''}}>
                                <label for="visibility_id">Visibility:
                                    <select name="visibility_id" id="visibility_id">
                                        @foreach($visibilities as $visibility)
                                            <option value="{{$visibility->id}}" {{$visibility->id == $bookmark->visibility->id ? 'selected' : ''}}>{{$visibility->name}}</option>
                                        @endforeach
                                    </select>
                                </label>

                                @if($errors->has('visibility_id'))
                                    <small class="error">{{$errors->get('visibility_id')[0]}}</small>
                                @endif
                            </div>

                            <div>
                                <label>Begin typing a users name to give them access</label>
                                <input type="text" id="autocomplete"/>

                                <div id="selected-items">

                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="column small-8">
                    <input type="submit" class="button tiny right" value="Update Bookmark"/>
                </div>

            </form>

        </div>
    </div>
@endsection