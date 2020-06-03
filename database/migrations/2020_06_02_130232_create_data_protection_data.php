<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataProtectionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_protection_data', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('data');
            $table->unsignedInteger('website_id')->nullable();
            $table->foreign('website_id')
                ->references('id')
                ->on('website')
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
        Schema::dropIfExists('data_protection_data');
    }
}
