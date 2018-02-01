<div class="bookmark listing">
    <h3><a href="{{url('bookmarks/'.$bookmark->id)}}">{{$bookmark->title}}</a></h3>
    <p>{{$bookmark->description}}</p>

    <div class="tagline">
        <img class="left-image" src="{{'https://www.google.com/s2/favicons?domain='.$bookmark->url}}" />
        <p class="flex">Bookmarked by {{$bookmark->user->name}} from <a href="{{$bookmark->url}}" class="link" target="_blank">{{$bookmark->getHostName()}}</a></p>
    </div>
</div>