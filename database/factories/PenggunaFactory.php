<?php

namespace Database\Factories;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PenggunaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = FakerFactory::create("id_ID");

        return [
            "nik" => $this->faker->nik,
            "nama_lengkap" => $this->faker->userName(),
            "password" => Hash::make("12345678")
        ];
    }
}
