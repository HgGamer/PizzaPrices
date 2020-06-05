<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataProtectionLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_protection_links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('main_filter_selector');
            $table->boolean('upToDate')->default(0);
            $table->unsignedInteger('website_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('item_schema_id')->nullable();
            $table->foreign('website_id')
                ->references('id')
                ->on('website')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('category_id')
                ->references('id')
                ->on('category')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('item_schema_id')
                ->references('id')
                ->on('item_schema')
                ->onUpdate('cascade')
                ->onDelete('set null');
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
        Schema::dropIfExists('data_protection_links');
    }
}
