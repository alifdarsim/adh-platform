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
        Schema::table('contract_expert', function (Blueprint $table) {
            $table->foreign(['project_expert_id'], 'contract_expert_ibfk_1')->references(['id'])->on('project_expert')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['template_id'], 'contract_expert_ibfk_2')->references(['id'])->on('contract_template')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_expert', function (Blueprint $table) {
            $table->dropForeign('contract_expert_ibfk_1');
            $table->dropForeign('contract_expert_ibfk_2');
        });
    }
};
