<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('komoditas', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['user_id']);

            // Buat foreign key baru dengan onDelete('cascade')
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('komoditas', function (Blueprint $table) {
            // Kembalikan seperti semula (tanpa cascade)
            $table->dropForeign(['user_id']);

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        });
    }
};
