<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    private function categories()
    {
        return [
            'travel' => 'Du lịch',
            'study'  => 'Học tập',
            'sport'  => 'Thể thao',
            'life'   => 'Đời sống',
        ];
    }

    private function menus()
    {
        $menus = [
            ['name' => 'Trang chủ', 'url' => '/'],
        ];

        foreach ($this->categories() as $slug => $label) {
            $menus[] = ['name' => $label, 'url' => '/#' . $slug];
        }

        return $menus;
    }

    public function index()
    {
        $menus = $this->menus();
        $categories = $this->categories();

        $posts = Post::orderBy('published_at', 'desc')->get();

        $sections = $posts->groupBy('category');
        $more = $posts->take(9);

        return view('home', compact('menus', 'categories', 'posts', 'sections', 'more'));
    }

    public function show(Post $post)
    {
        $menus = $this->menus();
        $categories = $this->categories();

        $latest = Post::where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $related = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('article', compact('menus', 'categories', 'post', 'latest', 'related'));
    }
}
