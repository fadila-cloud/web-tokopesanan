<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTokoTable extends Migration
{
    /**
     * menjalankan migrasi
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('pesanan_toko', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreign('toko_id')->constrained('tokos');
            $table->foreign('pesanan_id')->constrained('pesanan'); 
        });
    }

    /**
     * membalikkan migrasi
     *
     * @return void
     */ 
    public function down(): void 
    {
        Schema::dropIfExists('pesanan_toko');
    }
}
