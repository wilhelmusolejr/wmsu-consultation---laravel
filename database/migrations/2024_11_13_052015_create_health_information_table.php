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
        Schema::create('health_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade'); // Links to appointment
            $table->string('height')->nullable(); // Height input, nullable if not required
            $table->string('weight')->nullable(); // Weight input, nullable if not required
            $table->string('weight_changed_past_year')->nullable(); // Yes/No for weight change
            $table->string('exercise')->nullable(); // Yes/No for exercise
            $table->string('medical_reason_no_exercise')->nullable(); // Yes/No for medical reason to not exercise
            $table->enum('stress_level', ['low', 'balanced', 'high'])->nullable(); // Stress level options
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_information');
    }
};