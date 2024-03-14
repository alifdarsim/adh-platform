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
        Schema::create('project_meetings', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('project_id')->nullable()->index('project_id');
            $table->string('name')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
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
        Schema::dropIfExists('project_meetings');
    }
};
