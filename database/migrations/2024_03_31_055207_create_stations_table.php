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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('manager_id')->unique()->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
            $table->string('address');
            $table->text('operating_hours');
            $table->text('facilities')->nullable();
            $table->enum('service_status', ['operational', 'maintenance', 'closed']);
            $table->timestamps();

            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
