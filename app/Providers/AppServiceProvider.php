<?php

namespace App\Providers;

use App\View\Components\Badge;
use App\View\Components\Card;
use App\View\Components\UpdatedCommentPost;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        //Add alias for component blade
        Blade::component(Badge::class, 'badge');
        Blade::component(UpdatedCommentPost::class, 'updateComment');
        Blade::component(Card::class, 'card');

    }
}
