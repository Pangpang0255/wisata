<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WisataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wisata = [
            [
                'nama_wisata' => 'Pantai Kuta',
                'deskripsi' => 'Pantai Kuta adalah salah satu pantai terindah di Bali dengan pasir putih dan ombak yang cocok untuk surfing.',
                'lokasi' => 'Kuta, Bali',
                'kategori' => 'Pantai',
                'harga_tiket' => 0,
                'jam_buka' => '00:00',
                'jam_tutup' => '23:59',
                'foto' => 'pantai-kuta.jpg',
                'rating' => 4.5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_wisata' => 'Candi Borobudur',
                'deskripsi' => 'Candi Borobudur adalah candi Buddha terbesar di dunia yang terletak di Magelang, Jawa Tengah.',
                'lokasi' => 'Magelang, Jawa Tengah',
                'kategori' => 'Candi',
                'harga_tiket' => 50000,
                'jam_buka' => '06:00',
                'jam_tutup' => '17:00',
                'foto' => 'borobudur.jpg',
                'rating' => 4.8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_wisata' => 'Gunung Bromo',
                'deskripsi' => 'Gunung Bromo adalah gunung berapi aktif yang terkenal dengan pemandangan sunrise yang menakjubkan.',
                'lokasi' => 'Probolinggo, Jawa Timur',
                'kategori' => 'Gunung',
                'harga_tiket' => 35000,
                'jam_buka' => '03:00',
                'jam_tutup' => '12:00',
                'foto' => 'bromo.jpg',
                'rating' => 4.7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_wisata' => 'Danau Toba',
                'deskripsi' => 'Danau Toba adalah danau vulkanik terbesar di Indonesia yang terletak di Sumatera Utara.',
                'lokasi' => 'Sumatera Utara',
                'kategori' => 'Danau',
                'harga_tiket' => 0,
                'jam_buka' => '00:00',
                'jam_tutup' => '23:59',
                'foto' => 'danau-toba.jpg',
                'rating' => 4.6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_wisata' => 'Raja Ampat',
                'deskripsi' => 'Raja Ampat adalah destinasi wisata bahari terbaik di Indonesia dengan keindahan bawah laut yang luar biasa.',
                'lokasi' => 'Papua Barat',
                'kategori' => 'Bahari',
                'harga_tiket' => 1000000,
                'jam_buka' => '06:00',
                'jam_tutup' => '18:00',
                'foto' => 'raja-ampat.jpg',
                'rating' => 5.0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('wisata')->insert($wisata);
    }
}
