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
        Schema::create('payment_receive', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('project_id')->nullable()->index('project_id');
            $table->unsignedMediumInteger('expert_id')->nullable();
            $table->string('transaction', 10)->nullable();
            $table->string('status')->nullable();
            $table->string('amount')->nullable();
            $table->string('invoice_path')->nullable();
            $table->string('receipt_path')->nullable();
            $table->text('info')->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->timestamp('created_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_receive');
    }
};
