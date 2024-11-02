<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paket;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paket>
 */
class PaketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_paket' => $this->faker->words(3, true),
            'deskripsi' => $this->faker->sentence(),
            'harga' => $this->faker->numberBetween(1000000, 10000000),
            'tgl_paket' => $this->faker->date(),
            'foto' => $this->faker->words(1, true),
            'kuota' => $this->faker->numberBetween(10, 100),
            'terisi' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
