<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('mejas')->insert([
            ['id' => 1, 'nama' => 'Meja VIP 1', 'tipe' => 'vip', 'harga_per_jam' => 50000, 'gambar' => 'vip1.jpg'],
            ['id' => 2, 'nama' => 'Meja VIP 2', 'tipe' => 'vip', 'harga_per_jam' => 50000, 'gambar' => 'vip2.jpg'],
            ['id' => 3, 'nama' => 'Meja VIP 3', 'tipe' => 'vip', 'harga_per_jam' => 50000, 'gambar' => 'vip3.jpg'],
            ['id' => 4, 'nama' => 'Meja VIP 4', 'tipe' => 'vip', 'harga_per_jam' => 50000, 'gambar' => 'vip4.jpg'],
            ['id' => 5, 'nama' => 'Meja VIP 5', 'tipe' => 'vip', 'harga_per_jam' => 75000, 'gambar' => 'vip5.jpg'],
            ['id' => 6, 'nama' => 'Meja VIP 6', 'tipe' => 'vip', 'harga_per_jam' => 75000, 'gambar' => 'vip6.jpg'],
            ['id' => 7, 'nama' => 'Meja Regular 1', 'tipe' => 'regular', 'harga_per_jam' => 30000, 'gambar' => 'regular1.jpg'],
            ['id' => 8, 'nama' => 'Meja Regular 2', 'tipe' => 'regular', 'harga_per_jam' => 30000, 'gambar' => 'regular2.jpg'],
            ['id' => 9, 'nama' => 'Meja Regular 3', 'tipe' => 'regular', 'harga_per_jam' => 30000, 'gambar' => 'regular3.jpg'],
            ['id' => 10, 'nama' => 'Meja Regular 4', 'tipe' => 'regular', 'harga_per_jam' => 30000, 'gambar' => 'regular4.jpg'],
            ['id' => 11, 'nama' => 'Meja Regular 5', 'tipe' => 'regular', 'harga_per_jam' => 30000, 'gambar' => 'regular5.jpg'],
            ['id' => 12, 'nama' => 'Meja Regular 6', 'tipe' => 'regular', 'harga_per_jam' => 30000, 'gambar' => 'regular6.jpg'],
        ]);
    }
}
