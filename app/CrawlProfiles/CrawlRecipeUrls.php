<?php

namespace App\CrawlProfiles;

use App\Observers\RecipeScraperObserver;
use Spatie\Crawler\CrawlProfiles\CrawlProfile;
use Psr\Http\Message\UriInterface;
use GuzzleHttp\Psr7\Uri;

class CrawlRecipeUrls extends CrawlProfile
{
    protected string $baseUrl;

    public function __construct(string $baseUrl)
    {
        if (!$baseUrl instanceof UriInterface) {
            $baseUrl = new Uri($baseUrl);
        }

        $this->baseUrl = $baseUrl;
    }

    /**
     * Determine if the given URL should be crawled.
     */
    public function shouldCrawl(UriInterface $url): bool
    {
        $urlString = (string) $url;

        return $urlString === RecipeScraperObserver::RECIPE_START_URL ||
            str_contains($urlString, RecipeScraperObserver::RECIPE_PAGE_URL);
    }
}
