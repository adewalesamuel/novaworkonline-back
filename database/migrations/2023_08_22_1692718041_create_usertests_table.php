<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')
			->constrained()
			->onDelete('cascade');
            $table->foreignId('user_id')
			->constrained()
			->onDelete('cascade');
			$table->enum('status', ['pending', 'finished'])->default('pending');
			$table->integer('current_step')->default(0);
			$table->integer('score'); //percent
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
        Schema::dropIfExists('usertests');
    }
}
