<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factory = new ProductFactory();
        $factory->count(10)->create();
    }
}
