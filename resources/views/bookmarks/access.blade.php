<div id="access-container" class="{{$visibility_id == 1 ? 'show' : 'hidden'}}">
    <label>Begin typing a users name to give them access</label>
    <input type="text" id="autocomplete" autocomplete="off"/>

    <div id="selected-items">
        @foreach($accessors as $access)
            <div class="selected-item">
                <span>{{ $access->user->name }}</span>
                <input type="hidden" name="access[]" value="{{$access->user_id}}" />
            </div>
        @endforeach
    </div>
</div>