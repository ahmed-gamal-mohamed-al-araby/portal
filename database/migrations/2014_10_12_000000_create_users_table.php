<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 255);
            $table->string('name_en', 255);
            $table->string('username', 255)->unique();
            $table->string('email', 255)->unique();
            $table->string('code', 10)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(Hash::make('123456'));
            $table->foreignId('manager_id')->nullable()->constrained('users');
            // sector_id
            // department_id
            // project_id

            // job_name_id
            // job_grade_id
            // job_grade_id
            $table->string('position_ar', 255)->nullable();
            $table->string('position_en', 255)->nullable();

            $table->boolean('active')->default(1);
            $table->string('profile')->nullable();
            $table->boolean('board_member')->default(0);
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
        Schema::dropIfExists('users');
    }
}
