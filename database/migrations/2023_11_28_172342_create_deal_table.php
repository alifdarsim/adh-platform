<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('company');
            $table->string('location');
            $table->string('deal_name');
            $table->string('hub_type');
            $table->string('deadline_date');
            $table->string('company_location');
            $table->json('target_country');
            $table->json('communication_language');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal');
    }
};
