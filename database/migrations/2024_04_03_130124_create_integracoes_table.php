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
        Schema::create('integracoes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_empresa');
            $table->string('nome');
            $table->enum('status',['ativo','inativo'])->default('inativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integracoes');
    }
};
