<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([

             UsersTableSeeder::class,
             TicketsTableSeeder::class,
             RolesTableSeeder::class,
             CategoriesTableSeeder::class,
             ModelHasRolesTableSeeder::class,
             EventsTableSeeder::class,
             ArticlesTableSeeder::class,
             TagsTableSeeder::class,
             NotifyTypeTableSeeder::class,

             ]);
    }
}
