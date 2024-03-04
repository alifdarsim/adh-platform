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
        Schema::create('cms_post_tag', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('post_id')->nullable()->index('post_id');
            $table->integer('tag_id')->nullable()->index('tag_id');
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
        Schema::dropIfExists('cms_post_tag');
    }
};
