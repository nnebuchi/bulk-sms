<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\ContactFormSubmissionMail;
use Illuminate\Support\Facades\Mail;

class ContactFormListener
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
     * @param  ContactFormSubmitted  $event
     * @return void
     */
    public function handle(ContactFormSubmitted $event)
    {
        Mail::to($event->enquiry->email)->send(new ContactFormSubmissionMail($event->enquiry));
    }
}
