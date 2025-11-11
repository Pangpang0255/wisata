<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the old table
        Schema::dropIfExists('wisata');
        
        // Create new wisata table with correct structure
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi');
            $table->string('kategori');
            $table->decimal('harga_tiket', 10, 2)->default(0);
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->decimal('rating', 3, 2)->default(0);
            $table->timestamps();
        });
        
        // Insert sample data
        $now = Carbon::now();
        DB::table('wisata')->insert([
            [
                'nama_wisata' => 'Lawang Sewu',
                'deskripsi' => 'Bangunan bersejarah peninggalan kolonial Belanda yang terkenal dengan arsitektur klasiknya dan memiliki banyak pintu',
                'lokasi' => 'Semarang, Jawa Tengah',
                'kategori' => 'Sejarah',
                'harga_tiket' => 20000,
                'jam_buka' => '08:00:00',
                'jam_tutup' => '17:00:00',
                'rating' => 4.5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_wisata' => 'Candi Prambanan',
                'deskripsi' => 'Kompleks candi Hindu terbesar di Indonesia yang dibangun pada abad ke-9, terkenal dengan arsitektur megah dan relief yang indah',
                'lokasi' => 'Yogyakarta, DIY',
                'kategori' => 'Sejarah',
                'harga_tiket' => 50000,
                'jam_buka' => '06:00:00',
                'jam_tutup' => '17:30:00',
                'rating' => 4.8,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_wisata' => 'Candi Borobudur',
                'deskripsi' => 'Candi Buddha terbesar di dunia dan situs warisan dunia UNESCO, terkenal dengan stupa megah dan relief kehidupan Buddha',
                'lokasi' => 'Magelang, Jawa Tengah',
                'kategori' => 'Sejarah',
                'harga_tiket' => 50000,
                'jam_buka' => '06:30:00',
                'jam_tutup' => '17:00:00',
                'rating' => 4.9,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_wisata' => 'Keraton Surakarta',
                'deskripsi' => 'Istana resmi Kasunanan Surakarta yang masih berfungsi hingga kini, menyimpan berbagai koleksi pusaka dan budaya Jawa',
                'lokasi' => 'Surakarta (Solo), Jawa Tengah',
                'kategori' => 'Budaya',
                'harga_tiket' => 15000,
                'jam_buka' => '08:30:00',
                'jam_tutup' => '14:00:00',
                'rating' => 4.3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_wisata' => 'Air Terjun Sarangan',
                'deskripsi' => 'Air terjun alami yang dikelilingi pemandangan pegunungan hijau dan udara sejuk, cocok untuk wisata alam',
                'lokasi' => 'Magetan, Jawa Timur',
                'kategori' => 'Alam',
                'harga_tiket' => 10000,
                'jam_buka' => '07:00:00',
                'jam_tutup' => '18:00:00',
                'rating' => 4.2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};
