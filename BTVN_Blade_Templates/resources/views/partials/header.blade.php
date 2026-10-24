<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="/">Sensive</a>
        <ul class="navbar-nav mx-auto flex-row gap-4">
            @foreach ($menus as $menu)
            <li class="nav-item">
                <a class="nav-link {{ $menu['active'] ? 'text-warning' : '' }}"
                    href="{{ $menu['url'] }}">{{ $menu['name'] }}</a>
            </li>
            @endforeach
        </ul>
    </div>
</nav>