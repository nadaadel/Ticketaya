<?php

use Illuminate\Database\Seeder;
use App\Event;
class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'name' => 'Tamer Honsy Concert' ,
            'description' => 'Tamer concert at Golf porto Marina',
            'photo' => 'photo',
            'category' => '1',
            'location' => 'El-Hamam',
            'avaliabletickets' => '20',
            'startdate' => '2018-5-1',
            'enddate' => '2018-6-6',
            'user_id' => '1',
        ]);

    }
}
