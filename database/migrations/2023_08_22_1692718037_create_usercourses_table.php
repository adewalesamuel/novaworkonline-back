<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usercourses', function (Blueprint $table) {
            $table->id();
			$table->integer('progress');
			$table->foreignId('course_id')
			->constrained()
			->onDelete('cascade');
			$table->foreignId('user_id')
			->constrained()
			->onDelete('cascade');
			$table->softDeletes();
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
        Schema::dropIfExists('usercourses');
    }
}
