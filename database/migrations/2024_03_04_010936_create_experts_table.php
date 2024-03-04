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
        Schema::create('experts', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedMediumInteger('industry_id')->nullable()->index('industry_id');
            $table->string('url')->nullable()->unique('url');
            $table->string('name')->nullable();
            $table->text('about')->nullable();
            $table->text('img_url')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->json('skills')->nullable();
            $table->json('languages')->nullable();
            $table->json('educations')->nullable();
            $table->json('experiences')->nullable();
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
        Schema::dropIfExists('experts');
    }
};
