<?php

namespace App\Listeners;

use App\Events\AdmissionProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\AdmissionProcessedMail;

class SendadmissionNotification
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
     * @param  \App\Events\AdmissionProcessed  $event
     * @return void
     */
    public function handle(AdmissionProcessed $event)
    {
        $admission = $event->admission;
        $email = setting('admin.emailnotification');
        \Mail::to(($email))
                    ->send(new AdmissionProcessedMail($admission,$email)); 
    }
}
