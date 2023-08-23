<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->string('password');
			$table->string('phone_number');
			$table->string('profil_img_url');
			$table->string('api_token');
			$table->boolean('is_active');
			$table->foreignId('country_id')
			->constrained()
			->onDelete('cascade');
			$table->foreignId('role_id')
			->constrained()
			->onDelete('cascade');
			$table->timestamp('email_verified_at')->nullable();
			$table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
