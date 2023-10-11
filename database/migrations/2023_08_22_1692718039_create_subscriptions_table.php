<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
			$table->enum('type', ['user', 'recruiter']);
			$table->integer('amount');
			$table->enum('payment_mode', ['mobile', 'card', 'cash', 'other']);
			$table->enum('payment_status', ['pending', 'valdated', 'failed'])->default('pending');
			$table->date('expiration_date'); //current month + pack duration
			$table->bigInteger('subscriber_id');
            $table->foreignId('subscription_pack_id')
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
        Schema::dropIfExists('subscriptions');
    }
}
