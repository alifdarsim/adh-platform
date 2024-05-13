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
        Schema::create('expert_imports', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('linkedin_url')->nullable();
            $table->string('status', 50)->nullable();
            $table->json('result')->nullable();
            $table->timestamp('last_scraped_at')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('expert_imports');
    }
};
