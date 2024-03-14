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
        Schema::create('project_invited', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('project_id')->nullable()->index('project_id');
            $table->string('email')->nullable();
            $table->boolean('accepted')->nullable();
            $table->timestamp('respond_at')->nullable();
            $table->string('token')->nullable();
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
        Schema::dropIfExists('project_invited');
    }
};
