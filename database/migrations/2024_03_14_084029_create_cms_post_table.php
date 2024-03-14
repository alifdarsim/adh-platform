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
        Schema::create('cms_post', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->text('featured_image_path')->nullable();
            $table->text('content')->nullable();
            $table->string('author')->nullable()->index('author_id');
            $table->tinyInteger('featured')->nullable()->default(0);
            $table->string('status')->nullable();
            $table->date('post_date')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
            $table->dateTime('created_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_post');
    }
};
