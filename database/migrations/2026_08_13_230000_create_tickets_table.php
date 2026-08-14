<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('device_id')->nullable()->constrained()->nullOnDelete();
            $table->text('problem_description');
            $table->text('diagnosis')->nullable();
            $table->string('status')->default('received');
            $table->string('priority')->default('medium');
            $table->dateTime('received_at')->nullable();
            $table->dateTime('estimated_completion_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
