<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Admin;

class AdminAuthenticationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test for Admin SignIn.
     *
     * @return void
     */
    public function test_an_admin_can_signIn()
    {
        $admin=Admin::create([
          'name'=>'Test Admin',
          'email'=>'test@admin.com',
          'password'=>'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
          'active'=>1
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->resize(1920, 1080);
            $browser->visit('/admin/login')
                    ->assertSee('Sign In (ADMIN)')
                    ->type('email', $admin->email)
                    ->type('password', 'secret')
                    ->press('Sign In')
                    ->assertSee('Dashboard');
        });
    }

    /**
     * A Dusk test for Admin Logout.
     *
     * @return void
     */
    public function test_an_admin_can_logout()
    {
        $admin=Admin::create([
        'name'=>'Test Admin',
        'email'=>'test@admin.com',
        'password'=>'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'active'=>1
      ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->resize(1920, 1080);
            $browser->loginAs($admin, 'admin')
                    ->visit('/admin/dashboard')
                    ->mouseover('#adminProfile')
                    ->clickLink('Logout')
                    ->assertPathIs('/');
        });
    }
}
