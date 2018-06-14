<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;
use App\NotifyType;

class NotifyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotifyType::insert([
            [ 'type' => 'tickets','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['type' =>'events','created_at' => Carbon::now(),'updated_at' => Carbon::now() ],
        ]);
    }
}
