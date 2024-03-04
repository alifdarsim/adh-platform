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
        Schema::create('companies', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('name')->nullable();
            $table->string('linkedin_vanity')->nullable();
            $table->text('slogan')->nullable();
            $table->string('website')->nullable();
            $table->integer('type_id')->nullable()->index('type');
            $table->year('establish')->nullable();
            $table->string('company_size')->nullable();
            $table->text('about')->nullable();
            $table->string('industry_id', 100)->nullable();
            $table->string('status', 50)->nullable();
            $table->text('img_url')->nullable();
            $table->json('specialties')->nullable();
            $table->json('others')->nullable();
            $table->json('pic')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index('user_id');
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
        Schema::dropIfExists('companies');
    }
};
