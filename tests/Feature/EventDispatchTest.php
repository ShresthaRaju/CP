<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Events\NewUserRegistered;
use App\User;

class EventDispatchTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test to make sure an event is dispatched when a new user is created.
     *
     * @return void
     */
    public function test_event_is_dispatched()
    {
        Event::fake();

        $user=factory(User::class)->create();

        Event::assertDispatched(NewUserRegistered::class, function ($event) use ($user) {
            return $event->user->id===$user->id;
        });
    }
}
