<?php

namespace App\Console\Command;

use App\Service\RssFeedService;
use Illuminate\Console\Command;

class FetchRssFeedCommand extends Command
{
    protected $signature = 'fetch:rss-feed';

    protected $description = 'Fetch and store RSS feed';

    public function handle(RssFeedService $rssFeedService): void
    {
        $rssFeedService->fetchRssFeed();
    }
}
