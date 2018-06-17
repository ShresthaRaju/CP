<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Models\Discussion;

class ReplyTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test for replying to a discussion.
     *
     * @return void
     */
    public function test_a_user_can_reply()
    {
        $user=factory(User::class)->create();
        $discussion=factory(Discussion::class)->create([
          'user_id'=>$user->id
        ]);

        $this->browse(function (Browser $browser) use ($user,$discussion) {
            $browser->loginAs($user)
                    ->visit('/discussion/'.$discussion->slug)
                    ->type('reply', 'First reply on this discussion')
                    ->press('Post Your Reply')
                    ->assertSee('First reply on this discussion');
        });
    }
}
