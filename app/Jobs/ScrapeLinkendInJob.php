<?php

namespace App\Jobs;

use App\Models\ExpertImport;
use App\Models\ExpertList;
use App\Services\LinkedInScrapeService;
use App\Services\ProcessScrapeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ScrapeLinkendInJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $expertImportId;

    public function __construct($expertImportId)
    {
        $this->expertImportId = $expertImportId;
    }

    public function handle(): void
    {
        Log::info('ScrapeLinkendInJob started');

        $expertImport = ExpertImport::findOrFail($this->expertImportId);
        try {
            // Scrape LinkedIn data using the external API
            $scrapedData = $this->scrapeLinkedInData($expertImport->linkedin_url);
            // Save the profile image
            $imageName = $this->saveProfileImage($scrapedData);
            // Update the 'result' column with the scraped data
            $expertImport->update([
                'result' => json_decode($scrapedData),
                'last_scraped_at' => now(), // Add this line to update the 'last_scraped_at' column
                'status' => 'scrapped',
                'profile_image' => $imageName,
            ]);
            // Save the scraped data to the 'expert_list' table
            $this->processed($scrapedData, $expertImport->linkedin_url, $imageName, new ProcessScrapeService());
        } catch (\Exception $e) {
            // Update the 'status' column to indicate failure
            $expertImport->update(['status' => 'failed']);
            // You can optionally log the error or take other actions
            \Log::error('ScrapeError: ' . $e->getMessage());
            // Your job logic here
            Log::info('ScrapeLinkendInJob not finish');
        }
    }

    public function failed(\Exception $exception): void
    {
        $expertImport = ExpertImport::findOrFail($this->expertImportId);
        $expertImport->update(['status' => 'failed']);
        \Log::error('ScrapeError: ' . $exception->getMessage());
    }

    public function scrapeLinkedInData($linkedinUrl): string
    {
        $linkedin = new LinkedInScrapeService();
        return $linkedin->scrape($linkedinUrl);
    }

    public function saveProfileImage($result)
    {
        $result = json_decode($result, true);
        $image = $result['data']['profilePic'];
        if ($image == "" || $image == null) {
            return '/images/expert_images/' . 'default.png';
        }
        $imageData = file_get_contents($image);
        $imageName = 'profile_' . time() . '.png';
        $path = public_path('/images/expert_images/' . $imageName);
        // if the folder does not exist, create it
        if (!file_exists(public_path('/images/expert_images'))) {
            mkdir(public_path('/images/expert_images'), 0777, true);
        }
        file_put_contents($path, $imageData);
        return '/images/expert_images/' . $imageName;
    }

    public function processed($result, $url, $imagePath, ProcessScrapeService $scrapeProcess)
    {
        $result = json_decode($result);
        $exist = ExpertList::where('url', $url)->first();
        $process = $scrapeProcess->processInfo($result->data, $exist, $imagePath);
        if ($process) {
            return success('Profile is successfully processed');
        }
        else return error('Something went wrong');
    }
}
