<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcome;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SendEmailTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A test for sending welcome email.
     *
     * @return void
     */
    public function test_a_welcome_email_is_sent()
    {
        Mail::fake();

        $user=factory(User::class)->create();

        // Assert a message was sent to the given user...
        Mail::assertSent(NewUserWelcome::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
