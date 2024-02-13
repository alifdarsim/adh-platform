<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_author', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->string('status')->nullable();
            $table->text('image')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('created_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_author');
    }
}
