<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\NewUserWelcome;

class SendWelcomeEmail implements ShouldQueue
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
     * @param  WelcomeNewUser  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        Mail::to($event->user->email)->send(new NewUserWelcome($event->user));
    }
}
