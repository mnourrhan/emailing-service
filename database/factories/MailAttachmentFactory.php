<?php

namespace Database\Factories;

use App\Models\Mail;
use App\Models\MailAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class MailAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MailAttachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $file = UploadedFile::fake()->image('avatar.jpg');
        return [
            'email_id' => 1,
            'file_path' => $file->path(),
            'name' => $this->faker->text,
        ];
    }
}
