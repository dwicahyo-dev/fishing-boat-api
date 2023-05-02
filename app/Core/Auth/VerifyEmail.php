<?php

namespace App\Core\Auth;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends \Illuminate\Auth\Notifications\VerifyEmail
{
    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            // 'verification.verify.index',
            'verification.verify',
            Carbon::now()->addHours(Config::get('auth.verification.expire', 24)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
                'email' => $notifiable->getEmailForVerification()
            ]
        );
    }
}
