<?php

namespace App\Jobs;

use App\Mail\ProjectInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendProjectInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;
    // Priority levels: high, default, low
    public $priority = 'default';

    protected $email;
    protected $expertName;
    protected $projectName;
    protected $message;
    protected $expert_url;
    protected $related_projects;

    public function __construct($email, $expertName, $projectName, $message, $expert_url, $related_projects)
    {
        $this->email = $email;
        $this->expertName = $expertName;
        $this->projectName = $projectName;
        $this->message = $message;
        $this->expert_url = $expert_url;
        $this->related_projects = $related_projects;
    }

    public function handle(): void
    {
        $mailData = [
            'expertName' => $this->expertName,
            'projectName' => $this->projectName,
            'content' => $this->message,
            'expert_url' => $this->expert_url,
            'related_projects' => $this->related_projects,
        ];

        Mail::to($this->email)->send(new ProjectInvitation($mailData));
    }
}
