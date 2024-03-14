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
        Schema::table('user_expert', function (Blueprint $table) {
            $table->foreign(['industry_id'], 'user_expert_ibfk_1')->references(['id'])->on('industry_expert')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['user_id'], 'user_expert_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_expert', function (Blueprint $table) {
            $table->dropForeign('user_expert_ibfk_1');
            $table->dropForeign('user_expert_ibfk_2');
        });
    }
};
