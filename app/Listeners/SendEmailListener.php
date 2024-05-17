<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Mail\EmailSend;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailListener
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(SendEmailEvent $event): void
    {
        foreach($event->userID as $user){
            Mail::to(User::find($user)->email)->send(new EmailSend($user));
        }

    }
}
