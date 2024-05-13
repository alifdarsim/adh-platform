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
        Schema::table('project_meetings', function (Blueprint $table) {
            $table->foreign(['user_id'], 'project_meetings_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['project_id'], 'project_meetings_ibfk_3')->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_meetings', function (Blueprint $table) {
            $table->dropForeign('project_meetings_ibfk_2');
            $table->dropForeign('project_meetings_ibfk_3');
        });
    }
};
