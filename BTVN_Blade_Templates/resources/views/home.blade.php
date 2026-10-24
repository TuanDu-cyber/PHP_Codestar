@extends('layouts.master')

@section('title', 'Trang chủ')

@section('hero')
<section class="bg-secondary text-white text-center py-5">
    <h5>Tours &amp; Travels</h5>
    <h1>Amazing Places on earth</h1>
    <p>December 12, 2018</p>
</section>
@endsection

@section('content')
<h2 class="mb-4">Bài viết mới nhất</h2>

@if (count($posts) > 0)
<div class="row">
    @foreach ($posts as $post)
    @include('partials.post-card', ['post' => $post])
    @endforeach
</div>
@else
<p class="text-muted">Chưa có bài viết nào.</p>
@endif
@endsection