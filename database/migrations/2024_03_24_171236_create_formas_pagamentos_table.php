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
        Schema::create('formas_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('empresas')->onDelete('cascade');
            $table->integer('id_gateway');
            $table->string('descricao');
            $table->enum('tipo',['debito','credito']);
            $table->decimal('taxa_real',10,2)->nullable();
            $table->decimal('taxa_porc',10,2)->nullable();
            $table->integer('id_bandeira');
            $table->enum('status',['ativo','inativo'])->default('ativo');
            $table->longText('token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formas_pagamentos');
    }
};
