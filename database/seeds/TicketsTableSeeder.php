<?php

use Illuminate\Database\Seeder;


class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('tickets')->insert([
           'name' => 'Tamer Honsy Yaaaa' ,
           'price' => '500',
           'description' => 'i want to sell this tickets',
           'photo' => 'photo',
           'quantity' => '6',
           'type' => '1',
           'is_sold' => '0',
           'category_id' => '1',
           'region' => 'smouha',
           'city' => 'alexandria',
           'user_id' => '1',
           'expire_date' => '1995-3-3',
       ]);
    }
}
