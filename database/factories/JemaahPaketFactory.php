<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Jemaah;
use App\Models\Paket;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JemaahPaket>
 */
class JemaahPaketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jemaah_id' => Jemaah::factory(),
            'paket_id' => Paket::factory(),
            'status_pendaftaran' => $this->faker->boolean,
            'tgl_pendaftaran' => $this->faker->date,
        ];
    }
}
