<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $menus = [
            ['name' => 'Trang chủ', 'url' => '/'],
        ];

        foreach (Post::CATEGORIES as $slug => $label) {
            $menus[] = ['name' => $label, 'url' => '/#' . $slug];
        }

        View::share('menus', $menus);
    }
}
