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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal')->nullable();
            $table->integer('jumlah');
            $table->text('keterangan');
            $table->string('pembayaran')->nullable();
            $table->string('kategori');
            $table->text('sekertaris')->nullable();
            $table->text('bendahara')->nullable();
            $table->text('ketua')->nullable();
            $table->text('status')->nullable();
            $table->string('foto')->nullable();
            $table->string('lama')->nullable();
            $table->string('pengeluaran_id')->nullable();
            $table->foreignId('data_warga_id')->references('id')->on('data_wargas')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
