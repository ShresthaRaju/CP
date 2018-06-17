<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomePageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test for homepage.
     *
     * @return void
     */
    public function test_homepage_is_displayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1920, 1080);
            $browser->visit('/')
                    ->assertSeeLink('Join the Discussion');
        });
    }

    /**
     * A Dusk test for links.
     *
     * @return void
     */
    public function test_a_user_can_click_links()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Leaderboard')
                    ->assertPathIs('/discussions/leaderboard');
        });
    }
}
