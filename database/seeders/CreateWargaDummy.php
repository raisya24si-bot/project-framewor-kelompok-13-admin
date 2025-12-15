<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateWargaDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 50) as $i) {
            DB::table('warga')->insert([
                'no_ktp' => $faker->unique()->nik,
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama' => $faker->randomElement([
                    'Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'
                ]),
                'pekerjaan' => $faker->jobTitle,
                'telp' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
