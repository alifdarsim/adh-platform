<?php

// app/Mailers/RegisterMailer.php
namespace App\Mail;

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
    public function sendProjectInvitation($email, $expertName, $projectName, $expert_url): void
    {
        $mailData = [
            'expertName' => $expertName,
            'projectName' => $projectName,
            'expert_url' => $expert_url,
        ];
        Mail::to($email)->send(new ProjectInvitation($mailData));
    }
}
