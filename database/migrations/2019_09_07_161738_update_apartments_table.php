<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
          $table->decimal('latitude', 10, 7)->after('address')->nullable();
          $table->decimal('longitude', 10, 7)->after('latitude')->nullable();

          $table->boolean('is_sponsored')->after('is_public')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('apartments', function (Blueprint $table) {
        $table->dropColumn('latitude');
        $table->dropColumn('longitude');

        $table->dropColumn('is_sponsored');
      });
    }
}
