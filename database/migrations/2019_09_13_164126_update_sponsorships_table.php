<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSponsorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('sponsorships', function (Blueprint $table) {
        $table->timestamp('updated_at')->nullable();
        $table->timestamp('sponsor_end_at')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('sponsorships', function (Blueprint $table) {
        $table->dropColumn('sponsor_end_at');
      });
    }
}
