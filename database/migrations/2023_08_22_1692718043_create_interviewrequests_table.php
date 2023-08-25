<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviewrequests', function (Blueprint $table) {
            $table->id();
			$table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');
			$table->foreignId('recruiter_id')
			->constrained()
			->onDelete('cascade');
			$table->foreignId('user_id')
			->constrained()
			->onDelete('cascade');
			$table->string('slug');
			$table->text('description')->nullable()->default('');
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
        Schema::dropIfExists('interviewrequests');
    }
}
