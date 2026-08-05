<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DoctorRegMail extends Mailable
{
    use Queueable, SerializesModels;
public $data;
public $planTextPasssword;
    /**
     * Create a new message instance.
     */
    public function __construct($data,$planTextPasssword)
    {
        $this->data = $data;
        $this->planTextPasssword = $planTextPasssword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Doctor Reg Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.doctorRegEmail',with:['request'=>$this->data,'planTextPasssword'=>$this->planTextPasssword]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
