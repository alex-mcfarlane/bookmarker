<div class="bookmark bookmark-container listing">
    <h3><a href="{{url('bookmarks/'.$bookmark->id)}}">{{$bookmark->title}}</a></h3>
    <p>{{$bookmark->description}}</p>

    <div class="bookmark-meta-info">
        <img src="{{'https://www.google.com/s2/favicons?domain='.$bookmark->url}}" />

        <p >Bookmarked from <a href="{{$bookmark->url}}" class="link" target="_blank">{{$bookmark->getHostName()}}</a></p>
    </div>
</div>