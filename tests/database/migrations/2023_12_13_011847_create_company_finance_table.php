<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_finance', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->integer('revenue')->nullable();
            $table->integer('operating_profit')->nullable();
            $table->integer('net_profit')->nullable();
            $table->integer('total_assets')->nullable();
            $table->integer('current_market_capital')->nullable();
            $table->integer('capital')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('company_id', 'company_finance_ibfk_1')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_finance');
    }
}
