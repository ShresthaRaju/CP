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
        DB::table('users')->insert([

          [
            'name'=>'Raj',
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
          ],

          [
            'name'=>'Khem Gurung',
            'email'=>'khem@example.com',
            'username'=>'khem',
            'password'=>bcrypt('secret'),
            'display_image'=>null,
            'github'=>null,
            'linkedin'=>null,
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ],

          [
            'name'=>'Bhupendra',
            'email'=>'vupen@example.com',
            'username'=>'vupen',
            'password'=>bcrypt('secret'),
            'display_image'=>null,
            'github'=>null,
            'linkedin'=>null,
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ],

          [
            'name'=>'Karuna',
            'email'=>'karuna@example.com',
            'username'=>'karuna',
            'password'=>bcrypt('secret'),
            'display_image'=>null,
            'github'=>null,
            'linkedin'=>null,
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ],

          [
            'name'=>'Alina',
            'email'=>'alina@example.com',
            'username'=>'alina',
            'password'=>bcrypt('secret'),
            'display_image'=>null,
            'github'=>null,
            'linkedin'=>null,
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ],

          [
            'name'=>'Suman',
            'email'=>'suman@example.com',
            'username'=>'suman',
            'password'=>bcrypt('secret'),
            'display_image'=>null,
            'github'=>null,
            'linkedin'=>null,
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ],

          [
            'name'=>'Yogendra',
            'email'=>'yogen@example.com',
            'username'=>'yogen',
            'password'=>bcrypt('secret'),
            'display_image'=>null,
            'github'=>null,
            'linkedin'=>null,
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ],

          [
            'name'=>'Meelan',
            'email'=>'meelan@example.com',
            'username'=>'meelan',
            'password'=>bcrypt('secret'),
            'display_image'=>null,
            'github'=>null,
            'linkedin'=>null,
            'active'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
          ],

          [
            'name'=>'Hem',
            'email'=>'hem@example.com',
            'username'=>'hem',
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
