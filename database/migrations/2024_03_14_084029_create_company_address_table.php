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
        Schema::create('company_address', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('company_id')->nullable()->index('company_id');
            $table->text('address')->nullable();
            $table->string('city')->nullable()->index('city');
            $table->string('postal')->nullable();
            $table->string('state')->nullable()->index('state');
            $table->string('country')->nullable()->index('country');
            $table->string('emoji', 10)->nullable();
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
        Schema::dropIfExists('company_address');
    }
};
