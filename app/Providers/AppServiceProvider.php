<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Bu satır önemli!
use App\Models\Category;

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
    public function boot()
    {
        // Tüm görünümler için kategorileri paylaş
        View::composer('*', function ($view) {
            $categories = Category::all(); // Sadece kategorileri al
            $view->with('categories', $categories);
        });
    }
}
