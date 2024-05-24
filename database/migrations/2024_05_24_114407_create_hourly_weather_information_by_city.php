<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hourly_weather_information_by_city', function (Blueprint $table) {
            $table->id();
            $table->decimal('temp_c');
            $table->decimal('temp_f');
            $table->jsonb('condition');
            $table->decimal('wind_mph');
            $table->decimal('wind_kph');
            $table->decimal('wind_degree');
            $table->string('wind_dir');
            $table->integer('pressure_mb');
            $table->decimal('pressure_in');
            $table->decimal('cloud');
            $table->unsignedBigInteger('city_id');
            $table->timestamp('localtime');
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hourly_weather_information_by_city');
    }
};
