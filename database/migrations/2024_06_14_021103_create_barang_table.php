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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('merk',30)->nullable();
            $table->string('seri',40)->nullable();
            $table->text('spesifikasi')->nullable();
            $table->smallInteger('stok')->default(0);
            $table->foreignId('kategori_id')->nullable();
            $table->foreign('kategori_id')->references('id')->on('kategori')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
