<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Type\VoidType;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */ 
    public function up()
    { 
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama_pesanan'); 
            $table->decimal('total', 10, 2);  
            $table->timestamps();
            $table->foreign('user_id')->constrained('users'); 
            $table->foreign('toko_id')->constrained('tokos');
        });
    } 
    /**
     * Reverse the migrations. 
     *
     * @return void
     */     
    public function down(): void 
    {
        Schema::dropIfExists('pesanans');
    }
}
