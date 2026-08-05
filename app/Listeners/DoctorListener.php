<?php

namespace App\Listeners;

use App\Events\DoctorRegEvent;
use App\Mail\DoctorRegMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DoctorListener implements ShouldQueue
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DoctorRegEvent $event): void
    {
      Mail::to($event->data->email)->send(new DoctorRegMail($event->data,$event->planTextPasssword));        //
    }
}
