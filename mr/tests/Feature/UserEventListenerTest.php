<?php

namespace Tests\Feature;

use App\Events\UserRegistered;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserEventListenerTest extends TestCase
{
    use RefreshDatabase;
    public function test_welcome_email_is_sent_when_user_is_registered()
{
    Mail::fake();

    $user = User::factory()->create([
        'name' => 'Jon Jones',
        'email' => 'Jon' . now()->timestamp . '@gmail.com',
        'password' => bcrypt('password'),
    ]);

    event(new UserRegistered($user));

    Mail::assertSent(WelcomeMail::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
}
}