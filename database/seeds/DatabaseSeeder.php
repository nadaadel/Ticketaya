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
<<<<<<< HEAD
             CategoriesTableSeeder::class,
=======
>>>>>>> 19dfdb867a66b8ed9159907abe842327f90f436b
             ModelHasRolesTableSeeder::class,
             EventsTableSeeder::class,
             CategoriesTableSeeder::class,



             ]);
    }
}
