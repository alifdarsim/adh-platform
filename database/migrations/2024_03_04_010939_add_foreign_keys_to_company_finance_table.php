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
        Schema::table('company_finance', function (Blueprint $table) {
            $table->foreign(['company_id'], 'company_finance_ibfk_1')->references(['id'])->on('companies')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_finance', function (Blueprint $table) {
            $table->dropForeign('company_finance_ibfk_1');
        });
    }
};
