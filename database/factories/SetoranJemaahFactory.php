<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JemaahPaket;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SetoranJemaah>
 */
class SetoranJemaahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jemaah_paket_id' => JemaahPaket::factory(),
            'nominal' => $this->faker->numberBetween(100000, 1000000),
            'waktu_setor' => $this->faker->dateTime(),
            'metode_setor' => $this->faker->randomElement(['Tunai', 'Transfer']),
            'status_setoran' => $this->faker->randomElement(['Pending', 'Terverifikasi', 'Ditolak']),
            'bukti_setor' => $this->faker->optional()->imageUrl(),
            'catatan' => $this->faker->optional()->sentence(),
        ];
    }
}
