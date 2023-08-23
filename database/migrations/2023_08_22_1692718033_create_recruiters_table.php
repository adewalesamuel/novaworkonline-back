<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiters', function (Blueprint $table) {
            $table->id();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email');
			$table->string('password');
			$table->date('birth_date');
			$table->string('gender');
			$table->string('phone_number');
			$table->string('location');
			$table->string('profil_img_url');
			$table->string('company_name');
			$table->string('company_info');
			$table->string('api_token');
			$table->boolean('is_active');
			$table->foreignId('country_id')
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
        Schema::dropIfExists('recruiters');
    }
}
