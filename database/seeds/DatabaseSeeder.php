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
            RolesSeeder::class,
            UsersSeeder::class,
            ProducersSeeder::class,
            ProductSeeder::class,
            PopularProductsSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
