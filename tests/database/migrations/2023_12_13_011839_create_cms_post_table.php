<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_post', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->text('featured_image_path')->nullable();
            $table->text('tags')->nullable();
            $table->text('content')->nullable();
            $table->integer('author_id')->nullable();
            $table->boolean('featured')->default(0);
            $table->string('status')->nullable();
            $table->date('post_date')->nullable();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('created_at')->useCurrent();
            
            $table->foreign('author_id', 'cms_post_ibfk_1')->references('id')->on('cms_author');
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
}
