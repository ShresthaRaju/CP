<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Admin;
use App\User;
use App\Models\Discussion;

class AdminPrivilegesTest extends TestCase
{
    use DatabaseMigrations;

    public function create_an_admin()
    {
        $admin=Admin::create([
          'name'=>'Test Admin',
          'email'=>'test@admin.com',
          'password'=>'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
          'active'=>1
        ]);

        return $admin;
    }

    /**
     * A test to check if admin can perform CRUD operation for a channel.
     *
     * @return void
     */
    public function test_an_admin_can_create_read_update_delete_a_channel()
    {
        $admin=$this->create_an_admin();

        $response=$this->actingAs($admin, 'admin');

        // to create a new channel
        $response = $this->json('POST', '/admin/channels', ['title'=>'Express Js']);
        $response->assertStatus(200)
                  ->assertJson(['status'=>[
                    'message'=>'Channel added successfully :)'
                    ]]);

        // to update a channel
        $response=$this->json('PUT', '/admin/channels/1', ['title'=>'Express JavaScript']);
        $response->assertStatus(200);

        // to delete a channel
        $response=$this->json('DELETE', '/admin/channels/1');
        $response->assertStatus(200);
    }

    /**
     * A test to check if admin can delete a discussion.
     *
     * @return void
     */
    public function test_an_admin_can_delete_a_discussion()
    {
        $discussion=factory(Discussion::class)->create();

        $admin=$this->create_an_admin();

        $response=$this->actingAs($admin, 'admin');

        $response = $this->json('DELETE', '/admin/discussions/'.$discussion->id);
        $response->assertStatus(200);
    }
}
