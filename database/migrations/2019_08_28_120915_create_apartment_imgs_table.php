<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_imgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('apartment_id')->unsigned();
            $table->string('path');
            $table->string('slug');
            $table->string('alt')->nullable();

            $table->timestamps();
            $table->foreign('apartment_id')->references('id')->on('apartments')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_imgs');
    }
}
