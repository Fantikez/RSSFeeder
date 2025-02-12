<?php

namespace App\Providers;

use App\Interfaces\RssFeedRepositoryInterface;
use App\Repositories\RssFeedRepository;
use Illuminate\Support\ServiceProvider;

class RssFeedRepositoryProviderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RssFeedRepositoryInterface::class, RssFeedRepository::class);
    }

    public function boot(): void
    {
    }
}
