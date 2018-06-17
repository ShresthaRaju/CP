<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;
use App\Models\Discussion;

class DiscussionTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test for Discussion [Create, Read and Update].
     *
     * @return void
     */
    public function testDiscussionCRUD()
    {
        $user=factory(User::class)->create(); //create() directly saves to database.
        $discussion=factory(Discussion::class)->make(); //make() makes a new instance of discussion but doesn't save to dababase yet.

        $this->browse(function (Browser $browser) use ($user,$discussion) {
            $browser->loginAs($user);

            //test create discussion
            $browser->visit('/discussion/create')
                    ->assertSee('Pick a Channel')
                    ->select('channel_id', $discussion->channel_id)
                    ->type('title', $discussion->title)
                    ->type('description', $discussion->description)
                    ->press('Publish Discussion')
                    ->assertPathIs('/discussion/'.$discussion->slug);

            //test update discussion
            $browser->visit('/discussion/'.$discussion->slug.'/edit')
                    ->assertValue('input[type="text"]', $discussion->title)
                    ->append('description', 'UpdatedText')
                    ->press('Update Discussion')
                    ->assertPathIs('/discussion/'.$discussion->slug);
        });
    }
}
