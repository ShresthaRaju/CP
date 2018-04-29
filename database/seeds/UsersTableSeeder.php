<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 10)->create();

        DB::table('users')->insert([
          [
            'name'=>'Raj Shrestha',
            'email'=>'raj@example.com',
            'username'=>'raj',
            'password'=>bcrypt('secret'),
            'display_image'=>'dp.jpg',
            'github'=>'ShresthaRaju',
            'linkedin'=>'rajushrestha7',
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ],

          [
            'name'=>'Sameer',
            'email'=>'sameer@example.com',
            'username'=>'sameer',
            'password'=>bcrypt('secret'),
            'display_image'=>null,
            'github'=>null,
            'linkedin'=>null,
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ]

        ]);
    }
}
