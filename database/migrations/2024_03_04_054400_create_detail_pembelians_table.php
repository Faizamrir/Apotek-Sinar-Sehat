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
        Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pembelian');
            $table->unsignedBigInteger('id_obat');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->float('diskon');
            $table->integer('subtotal');
            $table->timestamps();
            $table->foreign('id_obat')->references('id')->on('obats')->onDelete('cascade');
            $table->foreign('id_pembelian')->references('id')->on('pembelians')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelians');
    }
};
