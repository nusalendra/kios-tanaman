<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(30)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'budisetyo',
            'password' => 'password',
        ]);

        Kriteria::create([
            'nama' => 'Karakteristik Tanaman',
            'tipe' => 'Benefit',
            'bobot' => 0.4
        ]);

        Subkriteria::create([
            'kriteria_id' => 1,
            'nama' => 'Kecil',
            'skor' => 1,
        ]);

        Subkriteria::create([
            'kriteria_id' => 1,
            'nama' => 'Menengah',
            'skor' => 2,
        ]);

        Subkriteria::create([
            'kriteria_id' => 1,
            'nama' => 'Besar',
            'skor' => 3,
        ]);

        Kriteria::create([
            'nama' => 'Perawatan Tanaman',
            'tipe' => 'Cost',
            'bobot' => 0.25
        ]);

        Subkriteria::create([
            'kriteria_id' => 2,
            'nama' => 'Kering',
            'skor' => 3,
        ]);

        Subkriteria::create([
            'kriteria_id' => 2,
            'nama' => 'Menengah',
            'skor' => 2,
        ]);

        Subkriteria::create([
            'kriteria_id' => 2,
            'nama' => 'Basah',
            'skor' => 1,
        ]);

        Kriteria::create([
            'nama' => 'Keberlangsungan Hidup Tanaman',
            'tipe' => 'Benefit',
            'bobot' => 0.15
        ]);

        Subkriteria::create([
            'kriteria_id' => 3,
            'nama' => 'Baik',
            'skor' => 3,
        ]);

        Subkriteria::create([
            'kriteria_id' => 3,
            'nama' => 'Menengah',
            'skor' => 2,
        ]);

        Subkriteria::create([
            'kriteria_id' => 3,
            'nama' => 'Buruk',
            'skor' => 1,
        ]);

        Kriteria::create([
            'nama' => 'Keuntungan Membeli Tanaman',
            'tipe' => 'Benefit',
            'bobot' => 0.1
        ]);

        Subkriteria::create([
            'kriteria_id' => 4,
            'nama' => 'Estetika',
            'skor' => 3,
        ]);

        Subkriteria::create([
            'kriteria_id' => 4,
            'nama' => 'Kesehatan',
            'skor' => 2,
        ]);

        Subkriteria::create([
            'kriteria_id' => 4,
            'nama' => 'Ekonomi',
            'skor' => 1,
        ]);

        Kriteria::create([
            'nama' => 'Harga',
            'tipe' => 'Cost',
            'bobot' => 0.1
        ]);

        Subkriteria::create([
            'kriteria_id' => 5,
            'nama' => 'Murah',
            'skor' => 3,
        ]);

        Subkriteria::create([
            'kriteria_id' => 5,
            'nama' => 'Menengah',
            'skor' => 2,
        ]);

        Subkriteria::create([
            'kriteria_id' => 5,
            'nama' => 'Mahal',
            'skor' => 1.
        ]);
    }
}
