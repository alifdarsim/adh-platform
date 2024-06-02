<?php

namespace App\Services;

use App\Models\ExpertList;

class ProcessScrapeService
{

    public function __construct()
    {
    }

    public function processInfo($info, $exist, $profilePic = null){
        // convert info to object
        $data = $info;
        $url = 'https://www.linkedin.com/in/' . $data->publicIdentifier;
        $name = $data->fullName;
        $about = $data->about ?? null;
        $img = $profilePic;
        $country = $data->addressCountryOnly ?? $data->addressWithoutCountry;
        $address = $data->addressWithoutCountry;
        $skills = collect($data->skills)->map(fn ($e) => $e->title)->toArray();
        $languages = collect($data->languages)->map(fn ($e) => $e->title)->toArray();
        $educations = collect($data->educations)->map(function ($e){
            return [
                'school' => $e->title ?? '',
                'degree' => $e->subtitle ?? '',
                'duration' => $e->caption ?? '',
            ];
        })->toArray();
        $experiences = [];
        collect($data->experiences)->each(function ($e) use (&$experiences){
            if ($e->breakdown) {
                $company = $e->title;
                collect($e->subComponents)->map(function ($e) use ($company, &$experiences){
                    $experiences[] = [
                        'company' => $company ?? '',
                        'position' => $e->title ?? '',
                        'location' => explode(" · ", $e->metadata ?? '')[0],
                        'duration' => explode(" · ", $e->caption ?? '')[0],
                    ];;
                });
            }
            else {
                $experiences[] = [
                    'company' => explode(" · ", $e->subtitle ?? '')[0],
                    'position' => $e->title ?? '',
                    'location' => explode(" · ", $e->metadata ?? '')[0],
                    'duration' => explode(" · ", $e->caption ?? '')[0],
                ];
            }
        });
        if ($exist) {
            $exist->update([
                'url' => $url,
                'name' => $name,
                'about' => $about,
                'img_url' => $img,
                'country' => $country,
                'address' => $address,
                'skills' => $skills,
                'languages' => $languages,
                'educations' => $educations,
                'experiences' => $experiences
            ]);
            return $exist;
        }
        else {
            return ExpertList::create([
                'url' => $url,
                'name' => $name,
                'about' => $about,
                'img_url' => $img,
                'country' => $country,
                'address' => $address,
                'skills' => $skills,
                'languages' => $languages,
                'educations' => $educations,
                'experiences' => $experiences
            ]);
        }
    }


}
