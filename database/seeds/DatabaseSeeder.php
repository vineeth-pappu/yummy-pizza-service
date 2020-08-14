<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();
        // $this->call(UsersTableSeeder::class);
    	DB::table('users')->insert([
    		'menu_id' => mt_rand(1,10),
    		'category_id' => mt_rand(1,10),
    		'group_id' => mt_rand(1,10),
    	]);
    }
}
