<?php

namespace Tests\Feature;

use App\Jobs\SendEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SendingEmailsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function is_email_job_dispatched()
    {
        Queue::fake();
        $emails = [
            [
                "body" => "testing",
                "subject" => "test",
                "receiver_email" => "mnourrhan@gmail.com"
            ]
        ];
        $response = $this->json('POST', route('send.mails'),
            ['emails' => $emails, 'api_token' => env('API_TOKEN')]);
        $response->assertStatus(200);
        Queue::assertPushed(SendEmail::class);
    }

    /** @test */
    public function is_email_job_not_dispatched()
    {
        Queue::fake();
        $emails = [
            [
                "body" => "testing",
                "subject" => "test"
            ]
        ];
        $response = $this->json('POST', route('send.mails'),
            ['emails' => $emails, 'api_token' => env('API_TOKEN')]);
        $response->assertStatus(422);
        Queue::assertNotPushed(SendEmail::class);
    }

    /** @test */
    public function is_request_failed_without_api_token()
    {
        Queue::fake();
        $emails = [
            [
                "body" => "testing",
                "subject" => "test"
            ]
        ];
        $response = $this->json('POST', route('send.mails'),
            ['emails' => $emails]);
        $response->assertStatus(422);
        Queue::assertNotPushed(SendEmail::class);
    }
}
