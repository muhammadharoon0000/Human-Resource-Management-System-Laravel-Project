<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
		View::composer(
			'layout.main', 'App\Http\View\Composers\LayoutComposer'
		);
		View::composer(
			'projects.invoices.show', 'App\Http\View\Composers\LayoutComposer'
		);
		View::composer(
			'dashboard', 'App\Http\View\Composers\LayoutComposer'
		);
		View::composer(
			'layout.client', 'App\Http\View\Composers\LayoutComposer'
		);
		View::composer(
			'frontend.Layout.navigation', 'App\Http\View\Composers\LayoutComposer'
		);
    }
}
