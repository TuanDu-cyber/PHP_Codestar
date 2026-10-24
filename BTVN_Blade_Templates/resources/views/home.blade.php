@extends('layouts.master')

@section('title', 'Trang chủ | Frivizn News')

@section('content')

<div class="top-news">

    <section class="latest-news">
        <div class="headline">
            <p>Breaking News</p>
            <a href="#">
                <h1>Tin nóng: Thị trường và chính trường đón nhiều biến động trong ngày</h1>
            </a>
        </div>
    </section>

    <section class="top-stories">
        <h2>Top Stories</h2>
        <div class="headline headline-1">
            <a href="#">
                <h1>Chính phủ công bố gói hỗ trợ doanh nghiệp mới</h1>
            </a>
        </div>
        <div class="headline headline-2">
            <a href="#">
                <h1>Giá năng lượng thế giới tiếp tục biến động</h1>
            </a>
        </div>
        <div class="headline headline-3">
            <a href="#">
                <h1>Hội nghị quốc tế khai mạc với nhiều cam kết mới</h1>
            </a>
        </div>
    </section>

</div>

@forelse ($sections as $category => $posts)
<section class="{{ strtolower($category) }}" id="{{ strtolower($category) }}">
    <h2>{{ $category }}</h2>

    @foreach ($posts as $post)
    @include('partials.story', [
    'post' => $post,
    'extra' => $category === 'World' ? 'story-' . $loop->iteration : '',
    ])
    @endforeach
</section>
@empty
<p>Chưa có bài viết nào.</p>
@endforelse

@if ($more->count() > 0)
<section class="more" id="more">
    <h2>More...</h2>

    @foreach ($more as $post)
    <a href="{{ route('article.show', $post) }}">
        <div class="more-headline">
            <h3>{{ $post->title }}</h3>
            <p class="exact-time">{{ $post->published_at->format('H:i') }}h</p>
        </div>
    </a>
    @endforeach
</section>
@endif

@endsection