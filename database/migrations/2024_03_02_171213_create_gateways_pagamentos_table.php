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
        Schema::create('gateways_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->decimal('taxa_padrao',10,2);
            $table->enum('status',['ativo','inativo'])->default('ativo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways_pagamentos');
    }
};
