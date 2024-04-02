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
        Schema::create('dvelopers_taxas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_formas_pagamento');
            $table->foreign('id_formas_pagamento')->references('id')->on('formas_pagamentos')->onDelete('cascade');
            $table->decimal('taxa_real',10,2)->nullable();
            $table->decimal('taxa_porc',10,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dvelopers_taxas');
    }
};
