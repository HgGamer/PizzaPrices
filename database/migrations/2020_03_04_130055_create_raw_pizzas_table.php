<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawPizzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_pizzas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 355);
            $table->string('size', 200)->nullable();
            $table->string('price')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('source_link', 355)->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('website_id')->nullable();
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
        Schema::dropIfExists('raw_pizzas');
    }
}
