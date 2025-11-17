<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // ID user yang melakukan transaksi
        $table->unsignedBigInteger('meja_id'); // ID meja yang dipesan
        $table->decimal('harga', 10, 2); // Total harga
        $table->integer('jumlah_jam'); // Jumlah jam pemesanan
        $table->string('asal'); // Asal meja (vip/regular)
        $table->string('status')->default('completed'); // Status transaksi
        $table->timestamps(); // created_at dan updated_at

        // Foreign key untuk user_id
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        // Foreign key untuk meja_id
        $table->foreign('meja_id')->references('id')->on('mejas')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('transaksis');
}
};
