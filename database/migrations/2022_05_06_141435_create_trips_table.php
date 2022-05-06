<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver')
                ->nullable(true)
                ->constrained('users');
            $table->foreignId('passenger_first')
                ->nullable(true)
                ->constrained('users');
            $table->foreignId('passenger_two')
                ->nullable(true)
                ->constrained('users');
            $table->foreignId('passenger_three')
                ->nullable(true)
                ->constrained('users');
            $table->foreignId('departure_city')
                ->nullable(true)
                ->constrained('cities');
            $table->foreignId('city_of_arrival')
                ->nullable(true)
                ->constrained('cities');
            $table->date('start');
            $table->date('finish');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
};
