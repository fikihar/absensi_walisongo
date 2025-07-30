<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'guru', 'siswa'])->default('siswa');
            $table->rememberToken();
            $table->timestamps();
        });

        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email pengguna yang meminta reset password
            $table->string('token'); // Token reset password
            $table->timestamp('created_at')->nullable(); // Waktu pembuatan token reset password
        });

        // Tabel sessions untuk otentikasi dan sesi login (biasa digunakan dengan Fortify)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sesi
            $table->foreignId('user_id')->nullable()->index(); // Relasi dengan user (dapat null jika user tidak login)
            $table->string('ip_address', 45)->nullable(); // IP address pengakses
            $table->text('user_agent')->nullable(); // User-agent pengakses (browser/OS)
            $table->longText('payload'); // Data payload dari sesi
            $table->integer('last_activity')->index(); // Waktu terakhir aktif dalam sesi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
