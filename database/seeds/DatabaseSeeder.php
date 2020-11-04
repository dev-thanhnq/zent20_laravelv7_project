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
         $this->call(\Database\Seeders\ProductsTableSeeder::class);
         $this->call(\Database\Seeders\AuthorsTableSeeder::class);
         $this->call(\Database\Seeders\UsersTableSeeder::class);
         $this->call(\Database\Seeders\UserInfoTableSeeder::class);
         $this->call(\Database\Seeders\CategoriesTableSeeder::class);
         $this->call(\Database\Seeders\OrdersTableSeeder::class);
         $this->call(\Database\Seeders\ImagesTableSeeder::class);
    }
}
