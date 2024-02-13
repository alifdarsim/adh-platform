<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCompaniesUsersCompaniesIbfk1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_companies', function (Blueprint $table) {
            $table->foreign('user_id', 'users_companies_ibfk_1')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_companies', function(Blueprint $table){
            $table->dropForeign('users_companies_ibfk_1');
        });
    }
}
