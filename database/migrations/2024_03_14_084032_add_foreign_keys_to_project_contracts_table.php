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
        Schema::table('project_contracts', function (Blueprint $table) {
            $table->foreign(['project_id'], 'project_contracts_ibfk_1')->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_contracts', function (Blueprint $table) {
            $table->dropForeign('project_contracts_ibfk_1');
        });
    }
};
