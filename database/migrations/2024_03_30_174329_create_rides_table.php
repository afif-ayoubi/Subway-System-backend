<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departure_station_id');
            $table->unsignedBigInteger('arrival_station_id');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->enum('status', ['pending', 'ongoing', 'completed']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('departure_station_id')->references('id')->on('stations')->onDelete('cascade');
            $table->foreign('arrival_station_id')->references('id')->on('stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
