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
        Schema::table('project_target_info', function (Blueprint $table) {
            $table->foreign(['project_id'], 'project_target_info_ibfk_2')->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['industry_id'], 'project_target_info_ibfk_3')->references(['id'])->on('industry_expert')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_target_info', function (Blueprint $table) {
            $table->dropForeign('project_target_info_ibfk_2');
            $table->dropForeign('project_target_info_ibfk_3');
        });
    }
};
