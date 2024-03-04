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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreign(['created_by'], 'projects_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['hub_id'], 'projects_ibfk_2')->references(['id'])->on('hub_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['company_id'], 'projects_ibfk_3')->references(['id'])->on('companies')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['awarded_to'], 'projects_ibfk_4')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_ibfk_1');
            $table->dropForeign('projects_ibfk_2');
            $table->dropForeign('projects_ibfk_3');
            $table->dropForeign('projects_ibfk_4');
        });
    }
};
