<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Carbon\Carbon;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = array (
            array('name' => 'Sport' ,'created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Music','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Festival','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Travel','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Fashion','created_at' => Carbon::now(),'updated_at' => Carbon::now())
        );
        Tag::insert($tags);
    }
}
