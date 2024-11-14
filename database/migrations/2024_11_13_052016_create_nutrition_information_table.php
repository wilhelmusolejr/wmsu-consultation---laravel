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
        Schema::create('nutrition_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained('appointments')->onDelete('cascade'); // Links to appointment
            $table->string('meet_past_dietitian')->nullable(); // Yes/No for meeting a registered dietitian
            $table->string('special_diet')->nullable(); // Yes/No for following a special diet
            $table->string('food_preference')->nullable(); // Any food preferences
            $table->enum('who_grocery', ['Myself', 'Others'])->nullable(); // Who does the grocery shopping
            $table->enum('who_prepare_meal', ['Myself', 'Others'])->nullable(); // Who prepares meals
            $table->string('skip_meals')->nullable(); // Yes/No for skipping meals
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_information');
    }
};