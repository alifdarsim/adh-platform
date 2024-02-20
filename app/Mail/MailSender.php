<?php

// app/Mailers/RegisterMailer.php
namespace App\Mail;

use App\Jobs\SendAdminInvitation;
use App\Jobs\SendPasswordReset;
use App\Jobs\SendProjectInvitation;
use Illuminate\Support\Facades\Mail;

class MailSender
{
    /**
     * Send registration email to user.
     */
    public function sendRegistrationEmail($email, $token): void
    {
        $mailData = [
            'email' => $email,
            'token' => $token,
        ];
        Mail::to($email)->send(new RegisterUser($mailData));
    }

    /**
     * Send email to expert.
     */
    public function sendProjectInvitation($email, $expertName, $projectName, $content, $expert_url): void
    {
        SendProjectInvitation::dispatch($email, $expertName, $projectName, $content, $expert_url);
    }

    public function sendPasswordReset($email, $token): void
    {
        SendPasswordReset::dispatch($email,$token);
    }

    public function sendAdminInvitation($email, $name, $token): void
    {
        SendAdminInvitation::dispatch($email, $name, $token);
    }
}
