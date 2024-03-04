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
        Schema::create('project_answer', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('project_id')->nullable()->index('project_id');
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
            $table->json('answers')->nullable();
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
        Schema::dropIfExists('project_answer');
    }
};
