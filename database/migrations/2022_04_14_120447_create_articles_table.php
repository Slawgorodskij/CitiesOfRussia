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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable(true)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('title', 150)
                ->nullable(true);
            $table->text('description')
                ->nullable(true);
            $table->text('article_body')
                ->nullable(false); //последняя строка название файла со статьей включая расширение
            $table->string('slug', 255)
                ->nullable(true);
            $table->softDeletes();
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
