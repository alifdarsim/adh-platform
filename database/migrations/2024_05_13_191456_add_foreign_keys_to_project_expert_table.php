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
        Schema::table('project_expert', function (Blueprint $table) {
            $table->foreign(['project_id'], 'project_expert_ibfk_3')->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['expert_id'], 'project_expert_ibfk_4')->references(['id'])->on('experts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_expert', function (Blueprint $table) {
            $table->dropForeign('project_expert_ibfk_3');
            $table->dropForeign('project_expert_ibfk_4');
        });
    }
};
