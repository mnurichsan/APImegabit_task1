<?php

use Illuminate\Database\Seeder;
use SebastianBergmann\Comparator\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Factory(\App\User::class, 1)->create();
    }
}
