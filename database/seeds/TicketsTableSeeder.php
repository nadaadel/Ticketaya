<?php

use Illuminate\Database\Seeder;

use Carbon\carbon;
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
           'name' => 'Hamaki Concert Ticket' ,
           'price' => '500',
           'description' => 'i want to sell this tickets',
           'photo' => 'default.jpg',
           'quantity' => '6',
           'type' => '1',
           'is_sold' => '0',
           'category_id' => '1',
           'region_id' => 680007,
           'city_id' => 926 ,
           'user_id' => '1',
           'expire_date' => '1995-3-3',
           'created_at'=>Carbon::now(),
       ]);
    }
}
