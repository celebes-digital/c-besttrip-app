<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jemaah>
 */
class JemaahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_ktp' => $this->faker->name(),
            'nik' => $this->faker->unique()->numerify('####################'),
            'kelamin' => $this->faker->randomElement(['L', 'P']),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'no_hp' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'foto_ktp' => $this->faker->imageUrl(640, 480, 'people'),
            'nama_paspor' => $this->faker->name(),
            'no_paspor' => $this->faker->optional()->numerify('####################'),
            'foto_paspor' => $this->faker->optional()->imageUrl(640, 480, 'people'),
            'berlaku_paspor' => $this->faker->optional()->date(),
            'alamat' => $this->faker->address(),
            'kelurahan' => $this->faker->citySuffix(),
            'kecamatan' => $this->faker->citySuffix(),
            'kabupaten' => $this->faker->city(),
            'provinsi' => $this->faker->state(),
            'rt' => $this->faker->numerify('###'),
            'rw' => $this->faker->numerify('###'),
            'status_nikah' => $this->faker->numberBetween(0, 1),
        ];
    }
}
