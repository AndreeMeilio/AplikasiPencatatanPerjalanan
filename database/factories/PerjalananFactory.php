<?php

namespace Database\Factories;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerjalananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data_pengguna = Pengguna::select("nik")->get();

        return [
            //
            "id_perjalanan" => uniqid("pjln"),
            "nik" => $this->faker->randomElement($data_pengguna),
            "tanggal" => $this->faker->date(),
            "waktu" => $this->faker->time(),
            "suhu" => $this->faker->randomFloat(1, 34, 37),
            "lokasi" => $this->faker->address()
        ];
    }
}
