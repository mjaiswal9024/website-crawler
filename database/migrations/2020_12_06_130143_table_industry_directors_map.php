<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableIndustryDirectorsMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_director_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('industry_id')->nullable(false);
            $table->unsignedInteger('director_id')->nullable(false);
            $table->date('appointment_date')->nullable();
            $table->string('designation')->nullable();

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
        Schema::dropIfExists('industry_director_map');
    }
}
