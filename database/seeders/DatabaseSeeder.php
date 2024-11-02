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
        // Get all factory classes and run them
        $factories = [
            \Database\Factories\JemaahFactory::class,
            \Database\Factories\PaketFactory::class,
            \Database\Factories\JemaahPaketFactory::class,
            \Database\Factories\SetoranJemaahFactory::class,
        ];

        foreach ($factories as $factory) {
            $factory::new()->count(10)->create();
        }
    }
}
