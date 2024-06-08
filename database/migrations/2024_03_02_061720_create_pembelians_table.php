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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur');
            $table->unsignedBigInteger('id_supplier');
            $table->date('tgl_transaksi');
            $table->integer('diskon')->default(0);
            $table->integer('ppn')->default(0);
            $table->integer('total');
            $table->date('jatuh_tempo');
            $table->string('penerima');
            $table->boolean('status_lunas')->default(false);
            $table->timestamps();
            $table->foreign('id_supplier')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
