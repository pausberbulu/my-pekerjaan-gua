<?php

namespace App\Providers;

use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;
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
        View::composer('components.partials.sidebar', function ($view) {
            $view->with('workspaces', Workspace::where('owner_id', Auth::user()->id)->get());
        });
    }
}
