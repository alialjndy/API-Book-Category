<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
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
    public function boot()
    {
        Response::macro('api', function ($status, $message, $data = [], $code = 200) {
            return Response::json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ], $code);
        });
        //
        Response::macro('formatDate',function ($date,$format='Y/M/D'){
            return Carbon::parse($date)->format($format);
        });
    }
}
