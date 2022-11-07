<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            $table->string('cpf_client', 11);
            $table->string('cpf_provider', 11);
            $table->smallInteger('rating');

            $table->unsignedBigInteger('scheduling_id');
            $table->foreign('scheduling_id')->references('id')->on('schedulings')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamp('start')->nullable();            
            $table->timestamp('end')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
