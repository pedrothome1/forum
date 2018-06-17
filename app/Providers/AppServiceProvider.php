<?php

namespace App\Providers;

use App\Thread;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('threads.*', function ($view) {
            $view->with(['categories' => Category::orderBy('name')->get()]);
        });

        Carbon::setLocale('pt-BR');

        setlocale(LC_TIME, 'Portuguese');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
