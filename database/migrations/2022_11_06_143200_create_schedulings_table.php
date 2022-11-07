<?php

use App\Models\Scheduling;
use App\Models\SchedulingStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedulings', function (Blueprint $table) {
            $table->id();

            $table->string('title', 45);

            $table->unsignedBigInteger('scheduling_status_id')->nullable(false)->default(SchedulingStatus::CREATED);
            $table->foreign('scheduling_status_id')->references('id')->on('scheduling_statuses')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('chat_id')->nullable();
            $table->foreign('chat_id')->references('id')->on('chats');

            $table->timestamp('start_event')->nullable();            
            $table->timestamp('end_event')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedulings');
    }
};
