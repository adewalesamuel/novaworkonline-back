<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseLinkAndCourseLoginAndCoursePasswordToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('course_link')->nullable()->default('');
            $table->string('course_login')->nullable()->default('');
            $table->string('course_password')->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('course_link');
            $table->dropColumn('course_login');
            $table->dropColumn('course_password');
        });
    }
}
