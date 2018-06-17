<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class AuthenticationTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test for Registration
     *
     * @return void
     */
    public function test_a_user_can_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Join the Discussion')
                    ->assertSee('Join The Discussion')
                    ->type('name', 'Test Name')
                    ->type('email', 'test@dusk.com')
                    ->type('username', 'testdusk')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Join Now')
                    ->assertPathIs('/register');
        });
    }

    /**
     * A Dusk test for SignIn.
     *
     * @return void
     */
    public function test_a_user_can_signIn()
    {
        $user=factory(User::class)->create(); //generates a user using UserFactory class

        $this->browse(function (Browser $browser) use ($user) {
            $browser->resize(1920, 1080);
            $browser->visit('/')
                    ->clickLink('Sign In')
                    ->assertSee('Sign In')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Sign In')
                    ->assertSee('Welcome, '.$user->username);
        });
    }

    /**
     * A Dusk test for Logout.
     *
     * @return void
     */
    public function test_a_user_can_logout()
    {
        $user=factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->resize(1920, 1080);
            $browser->loginAs($user)
                    ->visit('/')
                    ->mouseover('#profile')
                    ->clickLink('Logout')
                    ->assertPathIs('/');
        });
    }
}
