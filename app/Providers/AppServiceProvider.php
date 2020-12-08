<?php

namespace App\Providers;

use App\Models\Category;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Cache::remember('home_categories', 5, function () {
            $categories = Category::get();
            return $categories;
        });
        View::share([
            'listCategories' => $categories,
        ]);
        Schema::defaultStringLength(191);
    }
}
