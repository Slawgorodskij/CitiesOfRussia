<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)
                ->nullable(true);
            $table->text('description')
                ->nullable(true);
            $table->foreignId('user_id')
                ->nullable(true)
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('city_id')
                ->nullable(true)
                ->constrained('cities')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('category_id')
                ->nullable(true)
                ->constrained('categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('slug', 255)
                ->nullable(true);
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
        Schema::dropIfExists('articles');
    }
};
