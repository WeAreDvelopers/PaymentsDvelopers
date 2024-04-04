<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos_ead_simples', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_integracao');
            $table->foreign('id_integracao')->references('id')->on('integracoes')->onDelete('cascade');
            
            $table->unsignedBigInteger('id_produto');
            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('cascade');
    
            $table->string('id_produto_ead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos_ead_simples');
    }
};
