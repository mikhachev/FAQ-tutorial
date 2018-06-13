<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'Ждет ответа',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Опубликован',
        ]);
        DB::table('statuses')->insert([
            'name' => 'Скрыт',
        ]);
         DB::table('statuses')->insert([
            'name' => 'Заблокирован',
        ]);
      
    }
}
