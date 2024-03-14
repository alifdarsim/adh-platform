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
        Schema::create('expert_linkedin_queue', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('url')->nullable()->unique('url');
            $table->tinyInteger('status')->nullable()->default(0);
            $table->json('result')->nullable();
            $table->timestamp('last_scrape')->nullable();
            $table->tinyInteger('processed')->nullable()->default(0);
            $table->timestamp('last_process')->nullable();
            $table->unsignedMediumInteger('expert_id')->nullable()->index('expert_list_id');
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
        Schema::dropIfExists('expert_linkedin_queue');
    }
};
