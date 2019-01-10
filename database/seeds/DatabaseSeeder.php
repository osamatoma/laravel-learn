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
        factory('App\User')->create();
        factory('App\Post')->create();
        factory('App\Photo')->create();
        factory('App\Comment', 50)->create();
    }
}
