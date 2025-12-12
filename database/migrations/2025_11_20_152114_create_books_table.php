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
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->text('description')->nullable();
        $table->string('cover_image')->nullable();
        $table->year('published_year')->nullable();
        $table->integer('quantity');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('books');
}

};
