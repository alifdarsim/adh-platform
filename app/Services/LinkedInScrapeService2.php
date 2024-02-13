<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyScrape;
use App\Models\CompanyType;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class LinkedInScrapeService2
{
    private mixed $rapidApiKey;

    public function __construct($rapidApiKey = null)
    {
        $this->rapidApiKey = $rapidApiKey ?? config('rapidapikey');
    }

    /**
     * @throws GuzzleException
     */
    public function scrape($vanity)
    {
        $prefillData = CompanyScrape::where('vanity', $vanity)->first();
        // check if the data is empty
        if ($prefillData == null || $prefillData->data == null) {
            $client = new Client();
            $response = $client->request('GET', 'https://linkedin-companies-data.p.rapidapi.com/?vanity_name=' . $vanity, [
                'headers' => [
                    'X-RapidAPI-Host' => 'linkedin-companies-data.p.rapidapi.com',
                    'X-RapidAPI-Key' => $this->rapidApiKey,
                ],
            ]);
            $data = json_decode($response->getBody());

            // Extracted logic for handling company type
            $this->handleCompanyType($data->type);

            // Extracted logic for handling Company creation or update
            $this->handleCompany($vanity, $data);

            return $data;
        }
        sleep(1);
        return $prefillData->data;
    }

    private function handleCompanyType($companyType): void
    {
        if ($companyType) {
            $companyType = trim($companyType);
            CompanyType::firstOrCreate(['name' => $companyType]);
        }
    }

    private function handleCompany($vanity, $data): void
    {
        $prefillData = CompanyScrape::where('vanity', $vanity)->first();
        if ($prefillData == null) {
            $prefillData = new CompanyScrape();
            $prefillData->vanity = $vanity;
            $prefillData->data = $data;
            $prefillData->save();
        }
    }
}
