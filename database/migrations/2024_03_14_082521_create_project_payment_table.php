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
        Schema::create('project_payment', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('project_id')->nullable()->index('project_id');
            $table->string('status')->nullable();
            $table->string('transaction_no')->nullable();
            $table->timestamp('update_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('project_payment');
    }
};
