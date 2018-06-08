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
            'name' => 'tamer hosny concert' ,
            'description' => 'SUPER STAR KARIM MOHSEN',
            'photo' => 'photo',
            'category_id' => '1',
            'region' => 'smouha',
            'city' => 'alexandria',
            'avaliabletickets' => '20',
            'startdate' => '2018-5-1',
            'enddate' => '2018-6-6',
            'user_id' => '1',
        ]);

    }
}
