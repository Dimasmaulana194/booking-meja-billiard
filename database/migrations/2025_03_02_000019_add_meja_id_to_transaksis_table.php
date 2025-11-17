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
    Schema::table('transaksis', function (Blueprint $table) {
        $table->unsignedBigInteger('meja_id')->after('user_id'); // Tambahkan kolom meja_id
        $table->foreign('meja_id')->references('id')->on('mejas')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->dropForeign(['meja_id']); // Hapus foreign key
        $table->dropColumn('meja_id'); // Hapus kolom meja_id
    });
}
};
