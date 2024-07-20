<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Type\VoidType;

class CreatePesanansTable extends Migration
{
    /**
     * menjalankan migrasi
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->foreign('toko_id')->constrained('tokos'); //Relasi dengan table tokos
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    } 
    /**
     * membalikkan migrasi
     *
     * @return void
     */     public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
