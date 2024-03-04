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
        Schema::table('companies', function (Blueprint $table) {
            $table->foreign(['type_id'], 'companies_ibfk_1')->references(['id'])->on('company_type')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['created_by'], 'companies_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('companies_ibfk_1');
            $table->dropForeign('companies_ibfk_2');
        });
    }
};
