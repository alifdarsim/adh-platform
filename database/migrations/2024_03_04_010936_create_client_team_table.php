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
        Schema::create('client_team', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedMediumInteger('company_id')->nullable()->index('company_id');
            $table->unsignedBigInteger('created_by')->nullable()->index('created_by');
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
        Schema::dropIfExists('client_team');
    }
};
