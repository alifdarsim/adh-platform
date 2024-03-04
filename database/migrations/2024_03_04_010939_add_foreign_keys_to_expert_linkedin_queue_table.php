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
        Schema::table('expert_linkedin_queue', function (Blueprint $table) {
            $table->foreign(['expert_id'], 'expert_linkedin_queue_ibfk_1')->references(['id'])->on('experts')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expert_linkedin_queue', function (Blueprint $table) {
            $table->dropForeign('expert_linkedin_queue_ibfk_1');
        });
    }
};
