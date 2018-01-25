@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="column small-12 medium-10 large-8">

            <form method="POST" action="/bookmarks" data-abide>

                <input type="hidden" value="{{csrf_token()}}"/>

                <div class="row">

                    <div class="column medium-8">
                        <fieldset>
                            <legend>Bookmark Details</legend>
                            <div {{ $errors->has('url') ? "class=error" : ""}}>
                                <label for="url">Url <span class="required">Required</span>
                                    <input type="text" name="url" id="url" placeholder="Enter the URL for the web page"/>
                                </label>

                                @if($errors->has('url'))
                                    <p class="error">{{$errors->get('url')[0]}}</p>
                                @endif
                            </div>

                            <div {{ $errors->has('title') ? "class=error" : ""}}>
                                <label for="title">Title <span class="required">Required</span>
                                    <input type="text" name="title" id="title" placeholder="Enter a title"/>
                                </label>
                            </div>

                            <div {{ $errors->has('description') ? "class=error" : ""}}>
                                <label for="description">Description <span class="required">Required</span>
                                    <input type="text" name="description" id="description" placeholder="Describe the page you are bookmarking"/>
                                </label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="column medium-4">
                        <fieldset>
                            <legend>Meta Info</legend>
                            <div>
                                <label for="categories">Categories:
                                    <select name="categories[]" id="categories" multiple>
                                        <option value="" disabled selected>Select a category:</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <div>
                                <label for="visibility_id">Visibility:
                                    <select name="visibility_id" id="visibility_id">
                                        @foreach($visibilities as $visibility)
                                            <option value="{{$visibility->id}}" {{$visibility->name == 'Public' ? 'selected' : ''}}>{{$visibility->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="column medium-8">
                        <input type="submit" class="button tiny right" value="Save Bookmark"/>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection