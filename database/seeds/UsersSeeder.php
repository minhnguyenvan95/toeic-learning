<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	App\User::create([
    		'name' => 'Minh Nguyen',
        	'email' => 'minh.nguyenvan95@gmail.com',
        	'password' => bcrypt('123456'),
        	'remember_token' => str_random(10),
        	'balance' => 1000,
        	'api_token' => 'e208bd1a6d3835f8a62e642f5693f9e3',
        	'type' => 'admin'
    	]);
        factory(App\User::class,10)->create();
    }
}
