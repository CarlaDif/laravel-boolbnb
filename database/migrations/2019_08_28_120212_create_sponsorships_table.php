<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('sponsor_type_id')->unsigned();
            $table->bigInteger('apartment_id')->unsigned();

            $table->foreign('sponsor_type_id')->references('id')->on('sponsor_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('apartment_id')->references('id')->on('apartments')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsorships');
    }
}
