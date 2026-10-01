<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
public function up(): void
{
    Schema::create('bahan_pembersih', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->integer('stok')->default(0);
    $table->string('satuan')->nullable();
    $table->timestamps();
});
}

    
    public function down(): void
    {
        Schema::dropIfExists('bahan_pembersih');
    }
};
