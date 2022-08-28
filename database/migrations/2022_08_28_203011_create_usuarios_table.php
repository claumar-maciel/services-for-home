<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();

            $table->string('email', 45)->unique();
            $table->string('senha');
            $table->string('nome', 45);
            $table->string('cpf', 11)->unique();
            $table->string('username', 45)->unique();
            $table->decimal('avaliacao', 4, 2)->default(0);

            $table->unsignedBigInteger('endereco_id');
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('contato_id');
            $table->foreign('contato_id')->references('id')->on('contatos')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
