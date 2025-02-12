<?php

namespace App\Http\Controllers;

use App\Service\RssFeedService;

class TestController extends Controller
{
    public function __construct(public RssFeedService $rssFeedService)
    {
    }

    public function __invoke()
    {
        $this->rssFeedService->fetchRssFeed();
    }
}
