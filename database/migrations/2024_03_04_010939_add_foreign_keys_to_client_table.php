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
        Schema::table('client', function (Blueprint $table) {
            $table->foreign(['user_id'], 'client_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['company_id'], 'client_ibfk_2')->references(['id'])->on('companies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client', function (Blueprint $table) {
            $table->dropForeign('client_ibfk_1');
            $table->dropForeign('client_ibfk_2');
        });
    }
};
