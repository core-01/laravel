<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApproveLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approve_loans', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('loan_duration')->nullable();
            $table->string('loan_amount')->nullable();
            $table->string('interest')->nullable();
            $table->string('emi_amount')->nullable();
            $table->string('processing_fees')->nullable();
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
        Schema::dropIfExists('approve_loans');
    }
}
