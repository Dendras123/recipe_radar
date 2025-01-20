<?php

namespace App\Http\Controllers;

use App\CrawlProfiles\CrawlRecipeUrls;
use App\Observers\RecipeScraperObserver;
use Illuminate\Http\Request;
use Spatie\Crawler\Crawler;

class RecipeScraperController extends Controller
{
    public function __invoke(Request $request)
    {
        $url = RecipeScraperObserver::RECIPE_START_URL;

        Crawler::create()
            ->setCrawlObserver(new RecipeScraperObserver())
            ->setCrawlProfile(new CrawlRecipeUrls($url))
            ->setMaximumDepth(1)
            ->setTotalCrawlLimit(10)
            ->setDelayBetweenRequests(250)
            ->startCrawling($url);
    }
}
