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
        Factory(\App\Roles::class, 2)->create();
        Factory(\App\User::class, 20)->create();
        Factory(\App\Post::class, 10)->create();
    }
}
