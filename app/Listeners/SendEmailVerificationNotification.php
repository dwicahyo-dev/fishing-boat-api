<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\OPTNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Http;

class SendEmailVerificationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Notification::send($event->user, new OPTNotification($event->user));

        Http::post('https://script.google.com/macros/s/AKfycbxFNsyMXW8chGL8YhdQE1Q1yBbx5XEsq-BJeNF1a6sKoowaL_9DtcUvE_Pp0r5ootgMhQ/exec', [
            'email' => $event->user->email,
            'subject' => 'Verify Email Address with OTP',
            'message' => (string) $event->user->otp,
            'token' => '1dy09eODblmBUCTnIwiY-hbXdzCpZC3jyR4l0ZJgqQqO9L7J3zsZOobdJ'
        ]);
    }
}
