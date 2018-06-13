<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'name' => 'admin2',
            'email' => 'admin2@admin.com',
            'password' => bcrypt('admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            // 'created_at' =>  date("Y-m-d H:i:s"),
            // 'updated_at' =>  date("Y-m-d H:i:s"),
        ]);
    }
}
