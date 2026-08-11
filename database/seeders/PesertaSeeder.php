<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert
        // Peserta::create([
        //     'name' => 'Prasetyo Ari Nugroho',
        //     'email' => 'prasetyoari.id@gmail.com',
        //     'age' => 20,
        //     'address' => 'Jakarta Selatan',
        //     ]);

        Peserta::factory(50)->create();
    }
}
