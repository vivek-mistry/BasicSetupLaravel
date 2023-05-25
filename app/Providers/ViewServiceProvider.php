<?php

namespace App\Providers;

use App\View\Components\common\CategoryDropDown;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::component('category-dropdown', CategoryDropDown::class);
    }
}
