<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Post::CATEGORIES;

        $posts = Post::orderBy('published_at', 'desc')->get();

        $sections = $posts->groupBy('category');
        $more = $posts->take(9);

        return view('home', compact('categories', 'posts', 'sections', 'more'));
    }

    public function show(Post $post)
    {
        $post->load('user');

        $categories = Post::CATEGORIES;

        $comments = $post->comments()->with('user')->latest()->get();

        $latest = Post::where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $related = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('article', compact('categories', 'post', 'comments', 'latest', 'related'));
    }
}
