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
        Schema::create('projects', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('pid')->nullable();
            $table->unsignedMediumInteger('company_id')->nullable()->index('company_id');
            $table->boolean('public')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('hub_id')->index('hub_id');
            $table->date('deadline');
            $table->string('status', 50)->nullable()->default('pending');
            $table->unsignedBigInteger('created_by')->nullable()->index('user_id');
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('handle_by')->nullable()->index('published_by');
            $table->json('questions')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
