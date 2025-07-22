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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('user_id'); // peminjam (general)
            $table->date('tanggal_pinjam');
            $table->text('alasan');
            $table->date('deadline')->nullable(); // diisi koor
            $table->enum('status', ['pending', 'approved', 'rejected', 'returned', 'late'])->default('pending');
            $table->boolean('notifikasi_telat')->default(false); // notifikasi jika telat
            $table->timestamps();
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
