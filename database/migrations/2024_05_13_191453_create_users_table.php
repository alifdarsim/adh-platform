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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('role')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->rememberToken();
            $table->string('token')->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('avatar_path')->nullable();
            $table->string('timezone')->nullable()->default('Asia/Singapore');
            $table->string('referer_code')->nullable();
            $table->unsignedBigInteger('referer_id')->nullable()->index('referer_id');
            $table->string('language', 10)->nullable()->default('en');
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
        Schema::dropIfExists('users');
    }
};
