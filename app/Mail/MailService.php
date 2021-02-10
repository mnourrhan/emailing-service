<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailService extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;

    protected $attachments_paths;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $attachments_paths)
    {
        $this->details = $details;
        $this->attachments_paths = $attachments_paths;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->details['subject']);
        $this->view('mails.email', ['body' => $this->details['body']]);
        foreach ($this->attachments_paths as $attachment){
            $this->attach($attachment);
        }
        return $this;
    }
}
