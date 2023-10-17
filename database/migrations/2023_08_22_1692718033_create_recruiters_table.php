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
			$table->string('firstname')->nullable()->default('');
			$table->string('lastname')->nullable()->default('');
			$table->string('email')->unique();
			$table->string('password');
			$table->date('birth_date')->nullable();
			$table->enum('gender', ['M', 'F', 'O'])->default('M');
			$table->string('phone_number')->nullable()->default('');
			$table->string('location')->nullable()->default('');
			$table->string('profil_img_url')->nullable()->default('');
			$table->string('company_name');
			$table->string('company_info')->nullable()->default('');
			$table->string('api_token');
			$table->boolean('is_active')->default(true);
			$table->foreignId('country_id')
            ->nullable()
			->constrained()
			->nullOnDelete('');
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
