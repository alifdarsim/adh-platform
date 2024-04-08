<?php

// app/Mailers/RegisterMailer.php
namespace App\Mail;

use App\Jobs\SendAdminInvitation;
use App\Jobs\SendExpertAwarded;
use App\Jobs\SendPasswordReset;
use App\Jobs\SendProjectInvitation;
use App\Jobs\SendVerificationEmail;
use Illuminate\Support\Facades\Mail;

class MailSender
{
    /**
     * Send registration email to user.
     */
    public function sendRegistrationEmail($email, $token): void
    {
        SendVerificationEmail::dispatch($email, $token);
    }

    /**
     * Send email to expert.
     */
    public function sendProjectInvitation($email, $expertName, $projectName, $content, $expert_url, $related_project): void
    {

        SendProjectInvitation::dispatch($email, $expertName, $projectName, $content, $expert_url, $related_project);
    }

    public function sendPasswordReset($email, $token): void
    {
        SendPasswordReset::dispatch($email,$token);
    }

    public function sendAdminInvitation($email, $name, $token): void
    {
        SendAdminInvitation::dispatch($email, $name, $token);
    }

    public function sendProjectAwarded($email, $project_name): void
    {
        SendExpertAwarded::dispatch($email, $project_name);
    }
}
