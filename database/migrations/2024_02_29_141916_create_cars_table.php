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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_number')->unique();
            $table->string('make',50);
            $table->string('model',150)->nullable();
            $table->enum('catrgory', array('SUV','Hatchback','Sedan','Convertible','Crossover','Station Wagon','Minivan','Pickup trucks')); 
            $table->text('description')->nullable();
            $table->year('year');
            $table->tinyInteger('seats');
            $table->enum('doors', array('2','3','4'));
            $table->tinyInteger('bags')->nullable();
            $table->smallInteger('fuel_full')->nullable();
            $table->enum('fuel_type',array('gas', 'diesel', 'electricity'));
            $table->enum('steering',array('Automatic', 'Manual'));
            $table->foreignId('price_id')->constrained(); 
            $table->foreignId('user_id')->constrained();
            $table->foreignId('color_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
