<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Visitor;
use Carbon\Carbon;
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
        $hour = Carbon::now()->hour;
        $greeting = 'Malam';

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Pagi';
        } elseif ($hour >= 12 && $hour < 15) {
            $greeting = 'Siang';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Sore';
        }

        $visit = Visitor::whereDate('date', Carbon::now())->count();
        $visitorall = Visitor::count();

        View::composer('*', function ($view) use ($visit, $visitorall, $greeting) {
            $view->with('pageTitle', session('pageTitle', 'Anwar Fauzi'));
            $view->with('visitor', session('visitor', $visit));
            $view->with('visitorall', session('visitorall', $visitorall));
            $view->with('greeting', $greeting);
        });
    }
}