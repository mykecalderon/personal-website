<?php

namespace App\Mail;

use App\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $contact_submission;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactSubmission $contact_submission)
    {
        $this->contact_submission = $contact_submission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->contact_submission->email)
                    ->subject('New Contact Submission')
                    ->markdown('emails.contact');
    }
}
