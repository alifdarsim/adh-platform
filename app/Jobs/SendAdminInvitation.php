<?php

namespace App\Jobs;

use App\Mail\AdminInvitation;
use App\Mail\ProjectInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAdminInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;
    // Priority levels: high, default, low
    public $priority = 'default';

    protected $email;
    protected $name;
    protected $token;

    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function handle(): void
    {
        $mailData = [
            'name' => $this->name,
            'token' => $this->token,
        ];

        Mail::to($this->email)->send(new AdminInvitation($mailData));
    }
}
