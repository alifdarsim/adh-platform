<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {

            // Drop the 'region_id' column if it's no longer needed
            $table->dropColumn('region_id');

            // Remove the foreign key constraint referencing the 'subregions' table
            // $table->foreign(['subregion_id'], 'country_subregion_final')->references(['id'])->on('subregions')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            // Drop the 'subregion_id' column if it's no longer needed
            $table->dropColumn('subregion_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropForeign('country_continent_final');
//            $table->dropForeign('country_subregion_final');
        });
    }
};
