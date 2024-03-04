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
        Schema::table('project_keyword', function (Blueprint $table) {
            $table->foreign(['project_id'], 'project_keyword_ibfk_1')->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['keyword_id'], 'project_keyword_ibfk_2')->references(['id'])->on('keywords')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_keyword', function (Blueprint $table) {
            $table->dropForeign('project_keyword_ibfk_1');
            $table->dropForeign('project_keyword_ibfk_2');
        });
    }
};
