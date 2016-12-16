<?php

namespace App\Providers;

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
        //
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

    private function bootTwitterSocialite()
    {
        $twitter = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $twitter->extend(
            'spoitfy',
            function ($app) use ($twitter) {
                $config = $app['config']['services.twitter'];
                return $twitter->buildProvider(TwitterProvider::class, $config);
            }
        );
    }
}
