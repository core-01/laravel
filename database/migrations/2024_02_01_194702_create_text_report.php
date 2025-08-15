<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTextReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_report', function (Blueprint $table) {
            $table->id();
            $table->string('report_code', 40);
            $table->string('language_code', 1)->nullable();
            $table->boolean('is_header')->nullable()->default(false);
            $table->boolean('is_footer')->nullable()->default(false);
            $table->foreignId('header_ref')->nullable()->references('id')->on('text_report');
            $table->foreignId('footer_ref')->nullable()->references('id')->on('text_report');
            
            //$table->foreign('header_ref','header_ref_fk')->references('id')->on('text_report');
            //$table->foreign('footer_ref','footer_ref_fk')->references('id')->on('text_report');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE text_report ADD report_content LONGBLOB");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_report');
    }
}
