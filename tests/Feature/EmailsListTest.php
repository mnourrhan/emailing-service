<?php

namespace Tests\Feature;

use App\Models\Mail;
use App\Models\MailAttachment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EmailsListTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    const PER_PAGE = 10;

    /** @test */
    public function is_emails_retrieved_with_attachments_successfully()
    {
        Storage::fake('public');
        $email = Mail::factory()->create();
        $file = UploadedFile::fake()->image('avatar.jpg');
        MailAttachment::factory()->create(['email_id' => $email->id, 'file_path' => $file->path()]);
        MailAttachment::factory()->create(['email_id' => $email->id, 'file_path' => $file->path()]);

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get(route('mails.index', ['api_token' => env('API_TOKEN')]));

        $data = $response->decodeResponseJson()["data"];
        $firstEmail = $data[0];

        $response->assertStatus(200);
        $this->assertEquals($firstEmail['receiver_email'], $email->receiver_email);
        $this->assertEquals($firstEmail['body'], $email->body);
        $this->assertEquals($firstEmail['subject'], $email->subject);
        $this->assertEquals(1, count($data));
        $this->assertEquals(2, count($firstEmail['attachments']));
    }

    /** @test */
    public function is_emails_retrieved_with_pagination()
    {
        Mail::factory(25)->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get(route('mails.index', ['api_token' => env('API_TOKEN')]));

        $response->assertStatus(200);
        $response->assertJson(['meta' => ['per_page' => self::PER_PAGE]]);
        $data = $response->decodeResponseJson()["data"];
        $this->assertEquals(10, count($data));
    }

    /** @test */
    public function is_emails_request_invalid_without_api_token()
    {
        Mail::factory(25)->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get(route('mails.index'));

        $response->assertStatus(422);
    }
}
