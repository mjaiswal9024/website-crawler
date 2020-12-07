<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableIndustryList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id')->nullable(false);
            $table->string('name')->unique()->nullable(false);
            $table->string('cin')->nullable();
            $table->string('state')->nullable();
            $table->string('status')->nullable();

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
        Schema::dropIfExists('industry_list');
    }
}
