<?php

namespace Tests\Feature;

use App\Mail\ContactFormSubmitted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mail;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function wont_submit_without_a_name()
    {
        $response = $this->json('POST', '/contact', [
            'email' => 'test@example.com',
            'message' => 'Lorem ipsum dolor sit amet',
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    function wont_submit_without_a_valid_email()
    {
        $response = $this->json('POST', '/contact', [
            'name' => 'John Doe',
            'message' => 'Lorem ipsum dolor sit amet',
        ]);

        $response->assertStatus(422);

        $response = $this->json('POST', '/contact', [
            'name' => 'John Doe',
            'email' => 'invalid-email.com',
            'message' => 'Lorem ipsum dolor sit amet',
        ]);
        $response->assertStatus(422);
    }

    /** @test */
    function wont_submit_without_a_message()
    {
        $response = $this->json('POST', '/contact', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    function contact_submission_stored_in_database()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'message' => 'Lorem ipsum dolor sit amet',
        ];

        $response = $this->json('POST', '/contact', $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('contact_submissions', $data);
    }

    /** @test */
    function sends_notification_email_after_submission()
    {
        Mail::fake();

        $response = $this->json('POST', '/contact', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'message' => 'Lorem ipsum dolor sit amet',
        ]);

        $response->assertStatus(200);

        Mail::assertQueued(ContactFormSubmitted::class, function ($mail) {
            return ! is_null($mail->contact_submission->id);
        });

        Mail::assertQueued(ContactFormSubmitted::class, function ($mail) {
            return $mail->hasTo(env('MAIL_FROM_ADDRESS'));
        });
    }
}
