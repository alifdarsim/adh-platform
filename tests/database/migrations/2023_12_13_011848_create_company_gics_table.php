<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyGicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_gics', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('class_sector_primary')->nullable()->index('class_sector_primary');
            $table->unsignedBigInteger('class_group_primary')->nullable()->index('class_group_primary');
            $table->unsignedBigInteger('class_industries_primary')->nullable();
            $table->unsignedBigInteger('class_sub_industries_primary')->nullable();
            $table->unsignedBigInteger('class_sector_secondary')->nullable();
            $table->unsignedBigInteger('class_group_secondary')->nullable();
            $table->unsignedBigInteger('class_industries_secondary')->nullable();
            $table->unsignedBigInteger('class_sub_industries_secondary')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('company_id', 'company_gics_ibfk_1')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_gics');
    }
}
