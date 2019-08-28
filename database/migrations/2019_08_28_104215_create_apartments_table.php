<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();

            $table->smallInteger('n_rooms');
            $table->smallInteger('n_single_beds')->nullable();
            $table->smallInteger('n_double_beds')->nullable();
            $table->smallInteger('n_baths');
            $table->smallInteger('mq');
            $table->string('address', 150);
            $table->text('description');
            $table->boolean('is_public');
            $table->float('price_per_night', 6,2);
            $table->string('main_img')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
