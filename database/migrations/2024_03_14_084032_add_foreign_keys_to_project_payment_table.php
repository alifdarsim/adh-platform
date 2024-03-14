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
        Schema::table('project_payment', function (Blueprint $table) {
            $table->foreign(['project_id'], 'project_payment_ibfk_1')->references(['id'])->on('projects')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_payment', function (Blueprint $table) {
            $table->dropForeign('project_payment_ibfk_1');
        });
    }
};
