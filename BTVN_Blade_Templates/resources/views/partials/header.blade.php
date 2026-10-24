<header role="banner">

    <section class="nav-section">

        <div class="logo">
            <a href="/" title="Frivizn logo">Frivizn</a>
        </div>

        <nav class="nav-menu" role="navigation">
            <ul class="nav-links">
                @foreach ($menus as $menu)
                <li><a href="{{ $menu['url'] }}" title="{{ $menu['name'] }}">{{ $menu['name'] }}</a></li>
                @endforeach
                <li>
                    <a href="#more" title="More">More...<span class="dropdown-toggle" aria-expanded="false"></span>
                        <span class="screen-reader-text">Expand child menu</span></a>
                    <ul class="sub-menu">
                        <li><a href="#" title="Science">Science</a></li>
                        <li><a href="#" title="Travel">Travel</a></li>
                        <li><a href="#" title="Health">Health</a></li>
                        <li><a href="#" title="Style">Style</a></li>
                        <li><a href="#" title="Weather">Weather</a></li>
                        <li><a href="#" title="Video">Video</a></li>
                    </ul>
                </li>
            </ul>
            <div class="burger">
                <div class="line-1"></div>
                <div class="line-2"></div>
                <div class="line-3"></div>
            </div>
        </nav>

    </section>

</header>