<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTokosTable extends Migration
{
    /**
     * menjalankan migrasi
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko'); 
            $table->string('address'); 
            $table->timestamps();
            $table->foreign('user_id')->constrained('users'); 
        });
    }
    /**
     * membalikkan migrasi
     *
     * @return void
     */
    public function down(): void 
    {
        Schema::dropIfExists('tokos');
    }
}

