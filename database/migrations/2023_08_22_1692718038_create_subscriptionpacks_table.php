<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_packs', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->string('slug')->unique();
			$table->text('description')->nullable()->default();
			$table->integer('price');
			$table->integer('duration');//month
			$table->enum('type', ['user', 'recruiter']);
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
        Schema::dropIfExists('subscription_packs');
    }
}
