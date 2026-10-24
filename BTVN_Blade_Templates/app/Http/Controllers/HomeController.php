<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $menus = [
            ['name' => 'Home',     'url' => '/', 'active' => true],
            ['name' => 'Archive',  'url' => '#', 'active' => false],
            ['name' => 'Category', 'url' => '#', 'active' => false],
            ['name' => 'Contact',  'url' => '#', 'active' => false],
        ];

        $posts = Post::orderBy('published_at', 'desc')->get();

        return view('home', compact('menus', 'posts'));
    }
}