<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheduling_statuses', function (Blueprint $table) {
            $table->id();

            $table->string('description', 24)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduling_statuses');
    }
};
