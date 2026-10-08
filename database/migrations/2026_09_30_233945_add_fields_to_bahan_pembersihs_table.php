<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bahan_pembersihs', function (Blueprint $table) {
            $table->string('nama_bahan');
            $table->string('merek')->nullable();
            $table->integer('stok')->default(0);
            $table->string('satuan');
        });
    }

    public function down(): void
    {
        Schema::table('bahan_pembersihs', function (Blueprint $table) {
            $table->dropColumn([
                'nama_bahan',
                'merek',
                'stok',
                'satuan',
            ]);
        });
    }
};