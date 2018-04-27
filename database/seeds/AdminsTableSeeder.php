<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
          'name'=>'Administrator',
          'email'=>'admin@example.com',
          'password'=>bcrypt('secret'),
          'active'=>1,
          'created_at'=>\Carbon\Carbon::now(),
          'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
