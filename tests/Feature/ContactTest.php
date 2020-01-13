<?php

namespace Tests\Feature;

use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use App\Mail\ContactFormSubmitted;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mail;
use Tests\TestCase;

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
        $this->mockCaptcha();

        $response = $this->json('POST', '/contact', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'message' => 'Lorem ipsum dolor sit amet',
            'g-recaptcha-response' => '1',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('contact_submissions', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'message' => 'Lorem ipsum dolor sit amet',
        ]);
    }

    /** @test */
    function sends_notification_email_after_submission()
    {
        Mail::fake();
        $this->mockCaptcha();

        $response = $this->json('POST', '/contact', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'message' => 'Lorem ipsum dolor sit amet',
            'g-recaptcha-response' => '1',
        ]);

        $response->assertStatus(200);

        Mail::assertQueued(ContactFormSubmitted::class, function ($mail) {
            return ! is_null($mail->contact_submission->id);
        });

        Mail::assertQueued(ContactFormSubmitted::class, function ($mail) {
            return $mail->hasTo(env('MAIL_FROM_ADDRESS'));
        });
    }

    private function mockCaptcha()
    {
        // prevent validation error on captcha
        NoCaptcha::shouldReceive('verifyResponse')
            ->once()
            ->andReturn(true);

        // provide hidden input for your 'required' validation
        NoCaptcha::shouldReceive('display')
            ->zeroOrMoreTimes()
            ->andReturn('<input type="hidden" name="g-recaptcha-response" value="1" />');
    }
}
