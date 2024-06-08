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
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->unsignedBigInteger('id_satuan')->nullable();
            $table->unsignedBigInteger('id_supplier')->nullable();
            $table->integer('harga');
            $table->integer('stok');
            $table->date('expired');
            $table->timestamps();
            $table->foreign('id_satuan')->references('id')->on('satuans')->onDelete('set null')->change();
            $table->foreign('id_supplier')->references('id')->on('suppliers')->onDelete('set null')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
