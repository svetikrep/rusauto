<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('brand')->index();
            $table->string('model');
            $table->string('slug')->unique();
            $table->unsignedSmallInteger('year');
            $table->unsignedBigInteger('price');
            $table->string('badge')->nullable();
            $table->string('image')->default('img/catalog-car.png');
            $table->string('mileage')->nullable();
            $table->string('engine')->nullable();
            $table->string('transmission')->nullable();
            $table->string('drive')->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
