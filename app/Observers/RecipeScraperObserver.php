<?php

namespace App\Observers;

use App\Models\Recepie;
use App\Models\User;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;
use Spatie\Crawler\CrawlObservers\CrawlObserver;

class RecipeScraperObserver extends CrawlObserver
{
    public const RECIPE_START_URL = 'https://www.nosalty.hu/receptek';
    public const RECIPE_PAGE_URL = 'https://www.nosalty.hu/recept/';

    private $content;
    private User $techUser;

    public function __construct()
    {
        $this->content = null;
        $this->techUser = User::recipeTechUser();
    }

    /*
     * Called when the crawler will crawl the url.
     */
    public function willCrawl(UriInterface $url, ?string $linkText): void
    {
        Log::info('willCrawl', ['url' => $url]);
    }

    /*
     * Called when the crawler has crawled the given url successfully.
     */
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        Log::info("Crawled: {$url}");

        if (!str_contains($url, self::RECIPE_PAGE_URL)) {
            return;
        }

        $crawler = new Crawler((string) $response->getBody());

        $recipeTitle = $crawler->filter('.p-article__title')->first()->innerText();
        $recipeContent = $crawler->filter('.p-recipe__directions div')->first()->html();

        $this->techUser->recepies()->firstOrCreate(
            ['name' => $recipeTitle],
            ['description' => $recipeContent]
        );

        Log::info("Recipe created from this url: {$url}");

        echo $recipeTitle;
        echo $recipeContent;
    }

    /*
     * Called when the crawler had a problem crawling the given url.
     */
    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        Log::error("Failed: {$url}");
    }

    /*
     * Called when the crawl has ended.
     */
    public function finishedCrawling(): void
    {
        Log::info("Finished crawling");
    }
}
