<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullble();
            $table->string('email')->nullble();
            $table->string('mobile')->nullble();
            $table->string('loan_amount')->nullble();
            $table->text('photo')->nullble();
            $table->text('adhar_card')->nullble();
            $table->text('pan_card')->nullble();
            $table->text('bank_statement')->nullble();
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
        Schema::dropIfExists('loan_requests');
    }
}
