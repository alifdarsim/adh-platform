<?php

namespace App\Jobs;

use App\Mail\AwardedExpert;
use App\Mail\PasswordResetMail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendExpertAwarded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;
    // Priority levels: high, default, low
    public $priority = 'default';

    protected $email;
    protected $token;
    protected $project_name;

    public function __construct($email, $project_name)
    {
        $this->email = $email;
        $this->project_name = $project_name;
    }

    public function handle(): void
    {
        $mailData = [
            'project_name' => $this->project_name,
        ];

        Mail::to($this->email)->send(new AwardedExpert($mailData));
    }

    public function failed(Exception $exception)
    {
        \Log::error('SendAwarded failed: ' . $exception->getMessage());
    }
}
