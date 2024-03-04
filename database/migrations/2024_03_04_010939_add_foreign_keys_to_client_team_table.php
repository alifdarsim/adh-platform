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
        Schema::table('client_team', function (Blueprint $table) {
            $table->foreign(['company_id'], 'client_team_ibfk_1')->references(['id'])->on('companies')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign(['created_by'], 'client_team_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_team', function (Blueprint $table) {
            $table->dropForeign('client_team_ibfk_1');
            $table->dropForeign('client_team_ibfk_2');
        });
    }
};
