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
            array('name' => 'Sport' ,'photo'=>'sports.jpg','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Music','photo'=>'music.jpeg','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Festival','photo'=>'festival.jpg','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Travel','photo'=>'travel.jpg','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
          //  array('name' => 'Fashion','photo'=>'fashion.jpg','created_at' => Carbon::now(),'updated_at' => Carbon::now()),
            array('name' => 'Others','photo'=>'others.jpg','created_at' => Carbon::now(),'updated_at' => Carbon::now())
        );
        Category::insert($categories);
    }
}
