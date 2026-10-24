<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    private function menus()
    {
        return [
            ['name' => 'Home',          'url' => '/'],
            ['name' => 'World',         'url' => '/#world'],
            ['name' => 'Politics',      'url' => '/#politics'],
            ['name' => 'Business',      'url' => '/#business'],
            ['name' => 'Sport',         'url' => '/#sport'],
            ['name' => 'Entertainment', 'url' => '/#entertainment'],
        ];
    }

    public function index()
    {
        $menus = $this->menus();

        $posts = Post::orderBy('published_at', 'desc')->get();

        $sections = $posts->groupBy('category');
        $more = $posts->take(9);

        return view('home', compact('menus', 'sections', 'more'));
    }

    public function show(Post $post)
    {
        $menus = $this->menus();

        $latest = Post::where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return view('article', compact('menus', 'post', 'latest'));
    }
}
