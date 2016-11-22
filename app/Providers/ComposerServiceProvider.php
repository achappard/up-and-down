<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('upAndDown.shared.vegas_slideshow', 'App\Http\ViewComposers\VegasSlideshowComposer');
        View::composer('admin.shared.main_sidebar', 'App\Http\ViewComposers\AdminMainNavComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
