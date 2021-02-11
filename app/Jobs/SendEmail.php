<?php

namespace App\Jobs;

use App\Mail\MailService;
use App\Services\CreatingMailsService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailData;

    protected $attachments;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $this->attachments = app(CreatingMailsService::class)->execute($this->emailData);
            // Allow only 2 emails every 1 second
            Redis::throttle('mail-service')->allow(2)->every(1)->then(function (){
                $email = new MailService($this->emailData, $this->attachments);
                Mail::to($this->emailData['receiver_email'])->send($email);
                DB::commit();
            }, function () {
                // Could not obtain lock; this job will be re-queued
                DB::rollBack();
                $this->release(2);
            });
        }catch(\Exception $e){
            Log::info($e);
            DB::rollBack();
        }
    }
}
