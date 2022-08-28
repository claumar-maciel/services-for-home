<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();

            $table->string('rua', 45);
            $table->string('numero', 10);
            $table->string('bairro', 45);
            $table->string('cidade', 45);
            $table->string('estado', 2);
            $table->string('cep', 8);
            $table->string('ponto_referencia', 45);
            $table->string('complemento', 45)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
