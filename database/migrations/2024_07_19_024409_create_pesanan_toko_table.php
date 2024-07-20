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
            $table->unsignedBigInteger('toko_id'); 
            $table->unsignedBigInteger('pesanan_id'); 
            $table->timestamps();

            $table->foreign('toko_id')->references('id')->on('tokos')->onDelete('cascade');
            $table->foreign('pesanan_id')->references('id')->on('pesanans')->onDelete('cascade');
        });
    }

    /**
     * membalikkan migrasi
     *
     * @return void
     */ 
    public function down()
    {
        Schema::dropIfExists('pesanan_toko');
    }
}
