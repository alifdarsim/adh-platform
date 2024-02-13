<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->nullable();
            $table->string('name');
            $table->string('position');
            $table->string('company');
            $table->string('location');
            $table->string('deal_name');
            $table->string('hub_type');
            $table->date('publish_date')->nullable();
            $table->date('deadline_date');
            $table->string('company_location');
            $table->json('target_country');
            $table->json('communication_language');
            $table->string('status');
            $table->boolean('archive')->default(0);
            $table->unsignedBigInteger('applied_by')->nullable();
            $table->timestamps();
            
            $table->foreign('applied_by', 'deals_ibfk_1')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
