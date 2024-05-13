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
        Schema::create('contract_expert', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('project_expert_id')->nullable()->index('project_id');
            $table->string('contract_id')->nullable();
            $table->unsignedMediumInteger('template_id')->nullable()->default(1)->index('content_id');
            $table->text('scope_work')->nullable();
            $table->string('currency')->nullable();
            $table->string('fee')->nullable();
            $table->timestamp('dateline')->nullable();
            $table->smallInteger('reversion')->nullable()->default(1);
            $table->string('adh_pic')->nullable();
            $table->text('adh_signature')->nullable();
            $table->timestamp('adh_sign_date')->nullable();
            $table->string('expert_name')->nullable();
            $table->string('expert_address')->nullable();
            $table->text('expert_signature')->nullable();
            $table->timestamp('expert_signed_date')->nullable();
            $table->string('status')->nullable()->default('pending');
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
        Schema::dropIfExists('contract_expert');
    }
};
