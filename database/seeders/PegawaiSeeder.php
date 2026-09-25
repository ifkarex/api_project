<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::create([
            'nama' => 'andrianto_RPL2A',
            'umur' => 25,
            'tanggal_masuk' => '2026-01-10',
        ]);

        Pegawai::create([
            'nama' => 'jason_ivano_RPl_2A',
            'umur' => 30,
            'tanggal_masuk' => '2025-08-15',
        ]);

        Pegawai::create([
            'nama' => 'M.madanyifkar_rpl_2A',
            'umur' => 28,
            'tanggal_masuk' => '2024-11-01',
        ]);
    }
}
