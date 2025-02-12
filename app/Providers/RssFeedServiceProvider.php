<?php

namespace App\Providers;

use App\Service\RssFeedService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class RssFeedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RssFeedService::class, function ($app) {
            return new RssFeedService(
                new Client ([
                        'timeout' => 10.0,
                    ]
                )
            );
        });
    }
}
