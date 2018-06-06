<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gategories')->insert([
            ['name' => 'fun',],['name' => 'sports',],
            
            ]);
    }
}