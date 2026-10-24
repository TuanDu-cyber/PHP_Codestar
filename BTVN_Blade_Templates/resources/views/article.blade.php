@extends('layouts.master')

@section('title', $post->title . ' | Frivizn News')

@section('main-class', 'main-article')

@section('content')

<article class="article">
    <h2>{{ $post->title }}</h2>
    <p>
        <small>{{ $post->published_at->format('d/m/Y, H:i') }}h · {{ $post->category }}</small><br>
        By Frivizn Reporter
    </p>

    <div class="headline"></div>

    <p class="intro-text">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident, nemo quo inventore,
        maxime iure consectetur adipisicing elit. Quo quasi enim praesentium tenetur quam,
        consequuntur quisquam officia itaque. Fuga aperiam tempore neque.
    </p>

    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis enim aliquid recusandae
        dolore beatae consequuntur odit vero. Nihil, veniam laborum.
    </p>

    <figure>
        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}">
        <figcaption>{{ $post->title }}</figcaption>
    </figure>

    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo quasi enim praesentium
        tenetur quam, consequuntur quisquam officia itaque. Fuga aperiam tempore neque, qui facere
        distinctio nisi illum minus iure! Ullam enim expedita qui beatae voluptatibus ex non
        possimus ea doloribus.
    </p>

    <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ad officiis nihil perspiciatis
        odio fugit asperiores! Eveniet beatae, quaerat repudiandae voluptatum ut, doloribus quas
        blanditiis non voluptatem magni autem molestiae sequi iusto voluptas eius repellendus.
    </p>

    {{-- Bình luận mẫu --}}
    @php
    $comments = [
    ['name' => 'johndoe123', 'replies' => 1],
    ['name' => 'janesmith', 'replies' => 4],
    ['name' => 'paul223', 'replies' => 3],
    ['name' => 'olivia1980', 'replies' => 2],
    ];
    @endphp

    <div class="comments">
        <p><a href="#">Comments({{ count($comments) }})</a></p>
        <h4>Top Comments</h4>

        @foreach ($comments as $comment)
        <p class="comment-name">{{ $comment['name'] }}</p>
        <div class="comment-text">
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta ipsam excepturi
                architecto inventore blanditiis eum quos distinctio, perspiciatis ratione doloribus.
            </p>
            <p><small>Replies({{ $comment['replies'] }})</small></p>
        </div>
        @endforeach
    </div>

    <h3>Comment Form</h3>
    <div class="form-container">
        <form action="#" onsubmit="return false;">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" placeholder="Your name..">

            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" placeholder="Your comment.." style="height:200px"></textarea>

            <input type="submit" value="Submit">
        </form>
    </div>
</article>

<aside class="sidebar" role="complementary">
    <h2>Most Read</h2>
    @foreach ($latest as $item)
    <a href="{{ route('article.show', $item) }}">
        <div class="sidebar-headline">
            <h3>{{ $item->title }}</h3>
            <p class="exact-time">{{ $item->published_at->format('H:i') }}h</p>
        </div>
    </a>
    @endforeach

    <h2>Top Comments</h2>
    @foreach ($latest as $item)
    <a href="{{ route('article.show', $item) }}">
        <div class="sidebar-headline top-comments">
            <h3>{{ $item->title }}</h3>
            <p class="exact-time">{{ $loop->iteration }}</p>
        </div>
    </a>
    @endforeach
</aside>

@endsection