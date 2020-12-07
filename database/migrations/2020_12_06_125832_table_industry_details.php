<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableIndustryDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('industry_list_id')->nullable(false);
            $table->date('incorporation_date')->nullable();
            $table->unsignedInteger('registration_number')->nullable();
            $table->string('email')->nullable();
            $table->string('office_address')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->unsignedInteger('pin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industry_details');
    }
}
