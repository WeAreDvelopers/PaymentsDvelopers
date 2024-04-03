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
        Schema::create('integracoes_parametros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_integracao');
            $table->foreign('id_integracao')->references('id')->on('integracoes')->onDelete('cascade');
            $table->string('endpoint_producao')->nullable();
            $table->string('endpoint_sandbox')->nullable();
            $table->string('cliente_id')->nullable();
            $table->string('token_public')->nullable();
            $table->string('token_private')->nullable();
            $table->enum('ativado',['producao','sandbox'])->default('sandbox');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integracoes_parametros');
    }
};
