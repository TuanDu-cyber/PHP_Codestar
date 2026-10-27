@extends('layouts.master')

@section('title', 'Trang chủ | Góc Nhỏ')

@section('content')

@if ($posts->isEmpty())

<p>Chưa có bài viết nào.</p>

@else

<div class="top-news">

    <section class="latest-news">
        <div class="headline" style="background-image: url('{{ asset($posts->first()->image) }}')">
            <p>Mới nhất</p>
            <a href="{{ route('article.show', $posts->first()) }}">
                <h1>{{ $posts->first()->title }}</h1>
            </a>
        </div>
    </section>

    <section class="top-stories">
        <h2>Bài viết nổi bật</h2>
        @foreach ($posts->slice(1, 3) as $post)
        <div class="headline headline-{{ $loop->iteration }}" style="background-image: url('{{ asset($post->image) }}')">
            <a href="{{ route('article.show', $post) }}">
                <h1>{{ $post->title }}</h1>
            </a>
        </div>
        @endforeach
    </section>

</div>

@foreach ($categories as $slug => $label)
@if ($sections->has($slug))
<section class="{{ $slug }}" id="{{ $slug }}">
    <h2>{{ $label }}</h2>

    @foreach ($sections[$slug] as $post)
    @include('partials.story', [
    'post' => $post,
    'extra' => $slug === 'travel' ? 'story-' . $loop->iteration : '',
    ])
    @endforeach
</section>
@endif
@endforeach

<section class="more" id="more">
    <h2>Mới đăng gần đây</h2>

    @foreach ($more as $post)
    <a href="{{ route('article.show', $post) }}">
        <div class="more-headline">
            <h3>{{ $post->title }}</h3>
            <p class="exact-time">{{ $post->published_at->format('d/m') }}</p>
        </div>
    </a>
    @endforeach
</section>

@endif

@endsection