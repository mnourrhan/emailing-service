<?php

namespace App\Jobs;

use App\Mail\MailService;
use Illuminate\Bus\Queueable;
use Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    protected $attachments;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $attachments)
    {
        $this->details = $details;
        $this->attachments = $attachments;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new MailService($this->details, $this->attachments);
        Mail::to($this->details['receiver_email'])->send($email);
    }
}
