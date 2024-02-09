<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoursePriceColumnAndFirtPayementAmountColumnToJobTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_titles', function (Blueprint $table) {
            $table->integer('course_price')->nullable();
            $table->integer('first_payment_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_titles', function (Blueprint $table) {
            $table->dropColumn('course_price');
            $table->dropColumn('first_payment_amount');
        });
    }
}
