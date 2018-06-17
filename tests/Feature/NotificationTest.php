<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcome;
use App\Notifications\DiscussionFavorited;
use App\User;
use App\Models\Discussion;

class NotificationTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test to make sure a notification is sent on favoriting a discussion.
     *
     * @return void
     */
    public function test_noitification_is_sent()
    {
        Notification::fake();
        Mail::fake();

        $user1=factory(User::class)->create();
        $user2=factory(User::class)->create();
        $discussion=factory(Discussion::class)->create([
          'user_id'=>$user1->id
        ]);

        Mail::assertSent(NewUserWelcome::class, function ($mail) use ($user1,$user2) {
            return $mail->hasTo([$user1->email,$user2->email]);
        });

        $response=$this->actingAs($user2);

        $response = $this->json('POST', '/discussion/favorite', ['discussion'=>$discussion->id]);
        $response->assertStatus(200);

        Notification::assertSentTo($user1, DiscussionFavorited::class, function ($notification, $channels) use ($user2,$discussion) {
            return $notification->user->id===$user2->id && $notification->discussion->id===$discussion->id;
        });
    }
}
