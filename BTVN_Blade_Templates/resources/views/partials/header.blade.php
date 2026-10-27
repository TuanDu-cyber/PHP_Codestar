<header role="banner">

    <section class="nav-section">

        <div class="logo">
            <a href="/" title="Góc Nhỏ">Góc Nhỏ</a>
        </div>

        <nav class="nav-menu" role="navigation">
            <ul class="nav-links">
                @foreach ($menus as $menu)
                <li><a href="{{ $menu['url'] }}" title="{{ $menu['name'] }}">{{ $menu['name'] }}</a></li>
                @endforeach

                @guest
                <li><a href="{{ route('login') }}" title="Đăng nhập">Đăng nhập</a></li>
                <li><a href="{{ route('register') }}" title="Đăng ký">Đăng ký</a></li>
                @endguest

                @auth
                <li><a href="{{ route('post.index') }}" title="Bài viết của tôi">Bài của tôi</a></li>
                <li><a href="{{ route('post.create') }}" title="Viết bài">Viết bài</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" title="Đăng xuất">Đăng xuất ({{ Str::limit(Auth::user()->name, 15) }})</button>
                    </form>
                </li>
                @endauth

                <li>
                    <a href="#more" title="Thêm">Thêm<span class="dropdown-toggle" aria-expanded="false"></span>
                        <span class="screen-reader-text">Expand child menu</span></a>
                    <ul class="sub-menu">
                        <li><a href="#" title="Giới thiệu">Giới thiệu</a></li>
                        <li><a href="#" title="Liên hệ">Liên hệ</a></li>
                        <li><a href="#" title="Lưu trữ">Lưu trữ</a></li>
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