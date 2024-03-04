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
        Schema::create('company_finance', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('company_id')->nullable()->index('company_id');
            $table->integer('revenue')->nullable();
            $table->integer('operating_profit')->nullable();
            $table->integer('net_profit')->nullable();
            $table->integer('total_assets')->nullable();
            $table->integer('current_market_capital')->nullable();
            $table->integer('capital')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
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
};
