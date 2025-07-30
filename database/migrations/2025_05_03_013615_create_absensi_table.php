<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id(); // default: "id" sebagai primary key
            $table->foreignId('penempatan_id')->constrained('penempatan')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('jenis', ['masuk', 'pulang', 'izin', 'sakit', 'libur']);
            $table->text('alasan')->nullable();
            $table->timestamp('waktu')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
