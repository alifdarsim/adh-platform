<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_post_tag', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('post_id')->nullable();
            $table->integer('tag_id')->nullable();
            $table->dateTime('created_at')->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('post_id', 'cms_post_tag_ibfk_1')->references('id')->on('cms_post');
            $table->foreign('tag_id', 'cms_post_tag_ibfk_2')->references('id')->on('cms_tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_post_tag');
    }
}
