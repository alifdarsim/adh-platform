<?php

// app/Http/Requests/RegisterRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DealCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'position' => 'required',
            'company' => 'required',
            'location' => 'required',
            'deal_name' => ['required', 'min:7', 'max:255'],
            'hub_type' => 'required',
            'deadline_date' => 'required',
            'company_location' => 'required',
            'target_country' => 'required',
            'communication_language' => 'required',
            'terms_and_agreement' => ['required', 'accepted'],
        ];
    }
}
