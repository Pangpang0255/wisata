<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom role jika belum ada
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('user')->after('password');
            });
        }

        // Update admin yang sudah ada
        DB::table('users')
            ->where('email', 'admin@gmail.com')
            ->update(['role' => 'admin']);

        // Insert user baru jika belum ada
        $userExists = DB::table('users')->where('email', 'user@gmail.com')->exists();
        
        if (!$userExists) {
            DB::table('users')->insert([
                'name' => 'User Demo',
                'email' => 'user@gmail.com',
                'password' => password_hash('user123', PASSWORD_BCRYPT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function down(): void
    {
        // Hapus user demo
        DB::table('users')->where('email', 'user@gmail.com')->delete();
        
        // Hapus kolom role
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};
