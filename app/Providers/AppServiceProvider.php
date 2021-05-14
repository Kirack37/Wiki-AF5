<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\ResponseFactory;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->registerInertia();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::macro('modal', function ($modal) {
            inertia()->share(['modal' => $modal]);
        });
        

        Inertia::share('flash', function () {
            return [
                'success' => Session::get('success'),
                'error' => Session::get('error'),
            ];
        });
    }
    // public function registerInertia()
    // {
    //     Inertia::version(function () {
    //         return md5_file(public_path('mix-manifest.json'));
    //     });

    //     Inertia::share([
    //         OctaModal::key => fn () => Session::has(OctaModal::key) ? Cache::pull(Session::get(OctaModal::key)) : null,
    //         OctaResponse::key => fn () => Session::has(OctaResponse::key) ? Cache::pull(Session::get(OctaResponse::key)) : null,
    //         'flash' => fn () => [
    //             'success' => Session::get('success'),
    //             'error' => Session::get('error'),
    //         ],
    //         'errors' => fn () => Session::get('errors')
    //             ? Session::get('errors')
    //             ->getBag('default')
    //             ->getMessages()
    //             : (object) [],
    //     ]);
    // }
}
