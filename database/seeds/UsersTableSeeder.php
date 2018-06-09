<?php

use Illuminate\Database\Seeder;

use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nada',
            'email' => 'nada@gmail.com',
            'password' => bcrypt('123456'),
            'phone'=>'123456'
            
           
        ]);

    }
}
