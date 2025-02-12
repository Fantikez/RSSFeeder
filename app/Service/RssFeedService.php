<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SimpleXMLElement;
use App\Models\Post;

class RssFeedService
{
    const URI = 'https://lifehacker.com/rss';

    /**
     * @param Client $client
     */
    public function __construct(private readonly Client $client)
    {
    }

    /**
     * @return void
     */
    public function fetchRssFeed(): void
    {
        try {
            $response = $this->client->get(self::URI);
            $xml = new SimpleXMLElement($response->getBody());
            $xml = json_decode(json_encode($xml), true);
            foreach ($xml['channel']['item'] as $item) {
                if (!Post::where('link', $item['link'])->exists()) {
                    Post::create([
                        'title' => (string)$item['title'],
                        'link' => (string)$item['link'],
                        'description' => (string)$item['description'],
                        'pub_date' => Carbon::parse($item['pubDate'])->format('Y-m-d H:i:s'),
                    ]);
                }
            }
        } catch (GuzzleException $exception) {
            Log::error('Fetch error:' . $exception->getMessage());
        } catch (\Exception $exception) {
            Log::error('XML Parse Error:' . $exception->getMessage());
        }
    }
}
