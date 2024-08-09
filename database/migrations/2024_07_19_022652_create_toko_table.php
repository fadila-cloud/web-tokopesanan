<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTokoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void 
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko'); 
            $table->string('address'); 
            $table->timestamps();
            $table->foreign('user_id')->constrained('users'); 
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void 
    {
        Schema::dropIfExists('toko');
    }
}

