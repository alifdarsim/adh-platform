<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('website')->nullable();
            $table->integer('type')->nullable();
            $table->year('establish')->nullable();
            $table->text('overview')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('status', 50)->nullable();
            $table->unsignedBigInteger('registered_by')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            
            $table->foreign('type', 'companies_ibfk_1')->references('id')->on('company_type');
            $table->foreign('registered_by', 'companies_ibfk_2')->references('id')->on('users');
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
}
