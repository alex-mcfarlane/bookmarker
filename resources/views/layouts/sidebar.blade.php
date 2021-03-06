<aside id="main-sidebar">
    <div id="nav-icon-wrapper">
        <div id="nav-icon">
            <a href="#">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>

    <nav>
        <ul class="menu sidebar-navigation">
            @if(Auth::check())
                <li class="expandable">
                    <a href="#">
                        <div class="icon-container">
                            <i class="fa fa-bookmark"></i>
                        </div>
                        <span class="menu-text">Bookmarks</span>
                    </a>

                    <ul class="menu sub-menu">
                        <li><a href="/bookmarks/create">New</a></li>
                        <li><a href="/bookmarks?read=0&owner={{Auth::id()}}">Unread</a></li>
                        <li><a href="/bookmarks?read=1&owner={{Auth::id()}}">Archived</a></li>
                        <li><a href="/bookmarks?owner={{Auth::id()}}">Mine</a></li>
                        <li><a href="/bookmarks?owner={{Auth::id()}}&access={{Auth::id()}}">All</a></li>
                    </ul>
                </li>
                <li class="expandable">
                    <a href="#">
                        <div class="icon-container">
                            <i class="fa fa-tags"></i>
                        </div>

                        <span class="menu-text">Categories</span>
                    </a>

                    <ul class="menu sub-menu">
                        <li><a href="/categories/create">New</a></li>
                        <li><a href="">All</a></li>
                        <li><a href="">Unread</a></li>
                        <li><a href="">Archived</a></li>
                    </ul>
                </li>
            @endif
            <li class="expandable">
                <a href="#">
                    <div class="icon-container">
                        <i class="fa fa-binoculars"></i>
                    </div>

                    <span class="menu-text">Discover</span>
                </a>

                <ul class="menu sub-menu">
                    <li><a href="/discover">Newest</a></li>
                </ul>
            </li>
            <li class="expandable">
                <a href="#">
                    <div class="icon-container">
                        <i class="fa fa-address-card-o"></i>
                    </div>

                    <span class="menu-text">Account</span>
                </a>

                <ul class="menu sub-menu">
                    <li><a href="/bookmarks/create">New</a></li>
                    <li><a href="">All</a></li>
                    <li><a href="">Unread</a></li>
                    <li><a href="">Archived</a></li>
                </ul>
            </li>

        </ul>
    </nav>

</aside>