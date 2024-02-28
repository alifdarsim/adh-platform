<?php

namespace App\Jobs;

use App\Mail\PasswordResetMail;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPasswordReset implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;
    // Priority levels: high, default, low
    public $priority = 'default';

    protected $email;
    protected $token;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function handle(): void
    {
        $mailData = [
            'token' => $this->token,
        ];

        Mail::to($this->email)->send(new PasswordResetMail($mailData));
    }

    public function failed(Exception $exception)
    {
        \Log::error('SendPasswordReset failed: ' . $exception->getMessage());
    }
}
