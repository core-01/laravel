<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_data', function (Blueprint $table) {
            $table->id();
            $table->string('ref_data_code');
            $table->foreign('ref_data_code')->references('ref_data_code')->on('reference_data_type');
            $table->string('src_value', 100);
            $table->string('mapped_value', 500);
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
        Schema::dropIfExists('reference_data');
    }
}
