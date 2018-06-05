<?php

use Illuminate\Database\Seeder;
use App\Category;
use Carbon\carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array (
            array('name' => 'sport' ,'created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'concert','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'festival','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'travel','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Health','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Fashion','created_at' => Carbon::now(),'updated_at' => Carbon::now())
        );
        Category::insert($categories);
    }
}
