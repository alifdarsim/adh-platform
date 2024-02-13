<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyScrape;
use App\Models\CompanyType;
use App\Models\ExpertLinkedInQueue;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class LinkedInScrapeService
{
    private mixed $rapidApiKey;

    public function __construct($rapidApiKey = null)
    {
        $this->rapidApiKey = $rapidApiKey ?? config('rapidapikey');
    }

    /**
     * @throws GuzzleException
     */
    public function scrape($url): Object
    {
        $client = new Client();
        $response = $client->request('POST', 'https://linkedin-data-scraper.p.rapidapi.com/person', [
            'body' => '{
                        "link": "' . $url . '"
                    }',
            'headers' => [
                'X-RapidAPI-Host' => 'linkedin-data-scraper.p.rapidapi.com',
                'X-RapidAPI-Key' => $this->rapidApiKey,
                'content-type' => 'application/json',
            ],
        ]);
        $guzzle = $response->getBody();
        return json_decode($guzzle->getContents());
    }

}
