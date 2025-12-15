<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    public function run(): void
    {
        // Cegah double admin
        if (!User::where('email', 'raisya24si@mahasiswa.pcr.ac.id')->exists()) {
            User::create([
                'name' => 'raisya',
                'email' => 'raisya24si@mahasiswa.pcr.ac.id',
                'password' => Hash::make('Syaa061105'),
            ]);
        }
    }
}
