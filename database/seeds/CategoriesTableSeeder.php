<?php

use Illuminate\Database\Seeder;
use App\Category;
use Carbon\carbon;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array (
            array('name' => 'Sport' ,'created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Music','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Festival','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Travel','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Fashion','created_at' => Carbon::now(),'updated_at' => Carbon::now())
        );
        Category::insert($categories);
    }
}
