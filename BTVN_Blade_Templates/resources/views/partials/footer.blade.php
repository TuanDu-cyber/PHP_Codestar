<div class="footer-links">

    <ul class="social-media-links">
        <li><a href="http://twitter.com"><span class="screen-reader-text">Twitter</span></a></li>
        <li><a href="http://facebook.com"><span class="screen-reader-text">Facebook</span></a></li>
        <li><a href="http://linkedin.com"><span class="screen-reader-text">LinkedIn</span></a></li>
        <li><a href="http://youtube.com"><span class="screen-reader-text">YouTube</span></a></li>
        <li><a href="http://instagram.com"><span class="screen-reader-text">Instagram</span></a></li>
    </ul>

    <ul class="main-footer-links">
        @foreach ($menus as $menu)
        <li><a href="{{ $menu['url'] }}" title="{{ $menu['name'] }}">{{ $menu['name'] }}</a></li>
        @endforeach
    </ul>

    <ul class="info-links">
        <li><a href="#" title="Giới thiệu">Giới thiệu</a></li>
        <li><a href="#" title="Liên hệ">Liên hệ</a></li>
        <li><a href="#" title="Chính sách">Chính sách</a></li>
    </ul>

    <ul class="our-address">
        <li>Liên hệ:</li>
        <li>Hà Nội, Việt Nam</li>
        <li>email@example.com</li>
    </ul>

</div>

<footer role="contentinfo">
    <p>{{ date('Y') }} &copy; Góc Nhỏ - Blog cá nhân</p>
    <a class="scroll-top" href="#top"></a>
</footer>