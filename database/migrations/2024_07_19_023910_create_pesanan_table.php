<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Type\VoidType;
 
return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */ 
    public function up(): void 
    { 
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama_pesanan'); 
            $table->decimal('total');  
            $table->timestamps();
            $table->foreign('toko_id')->constrained('tokos');
            $table->foreign('user_id')->constrained('users'); 
        });
    } 
    /**
     * Reverse the migrations. 
     *
     * 
     */     
    public function down(): void 
    {
        Schema::dropIfExists('pesanan');
    }
}; 