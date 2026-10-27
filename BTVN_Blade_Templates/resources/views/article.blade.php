@extends('layouts.master')

@section('title', $post->title . ' | Góc Nhỏ')

@section('main-class', 'main-article')

@section('content')

<article class="article">
    <h2>{{ $post->title }}</h2>
    <p>
        <small>{{ $post->published_at->format('d/m/Y') }} · {{ $categories[$post->category] ?? $post->category }}</small><br>
        Viết bởi chủ blog
    </p>

    <div class="headline" style="background-image: url('{{ asset($post->image) }}')"></div>

    @foreach (preg_split('/\n\s*\n/', $post->content) as $paragraph)
    <p class="{{ $loop->first ? 'intro-text' : '' }}">{{ $paragraph }}</p>
    @endforeach

    <figure>
        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
        <figcaption>{{ $post->title }}</figcaption>
    </figure>

    @php
    $comments = [
    ['name' => 'minhanh98', 'text' => 'Bài viết hay quá, mình cũng đang muốn thử.', 'replies' => 1],
    ['name' => 'quanghuy', 'text' => 'Cảm ơn bạn đã chia sẻ, đọc rất thích!', 'replies' => 2],
    ['name' => 'thuytrang', 'text' => 'Mong bạn viết thêm nhiều bài như thế này.', 'replies' => 0],
    ];
    @endphp

    <div class="comments">
        <p><a href="#">Bình luận ({{ count($comments) }})</a></p>
        <h4>Bình luận nổi bật</h4>

        @foreach ($comments as $comment)
        <p class="comment-name">{{ $comment['name'] }}</p>
        <div class="comment-text">
            <p>{{ $comment['text'] }}</p>
            <p><small>Trả lời ({{ $comment['replies'] }})</small></p>
        </div>
        @endforeach
    </div>

    <h3>Để lại bình luận</h3>
    <div class="form-container">
        <form action="#" onsubmit="return false;">
            <label for="name">Tên của bạn</label>
            <input type="text" id="name" name="name" placeholder="Tên của bạn..">

            <label for="comment">Bình luận</label>
            <textarea id="comment" name="comment" placeholder="Viết bình luận.." style="height:200px"></textarea>

            <input type="submit" value="Gửi">
        </form>
    </div>
</article>

<aside class="sidebar" role="complementary">
    <h2>Bài mới nhất</h2>
    @foreach ($latest as $item)
    <a href="{{ route('article.show', $item) }}">
        <div class="sidebar-headline">
            <h3>{{ $item->title }}</h3>
            <p class="exact-time">{{ $item->published_at->format('d/m') }}</p>
        </div>
    </a>
    @endforeach

    @if ($related->isNotEmpty())
    <h2>Cùng chuyên mục</h2>
    @foreach ($related as $item)
    <a href="{{ route('article.show', $item) }}">
        <div class="sidebar-headline">
            <h3>{{ $item->title }}</h3>
            <p class="exact-time">{{ $item->published_at->format('d/m') }}</p>
        </div>
    </a>
    @endforeach
    @endif
</aside>

@endsection