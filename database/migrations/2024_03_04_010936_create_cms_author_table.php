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
        Schema::create('cms_author', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->string('company')->nullable();
            $table->string('status')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('cms_author');
    }
};
