<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 500);
            $table->string('name_en', 500);
            $table->text('description_ar');
            $table->text('description_en');
            $table->foreignId('sector_id')->constrained('sectors');
            $table->foreignId('manager_id')->constrained('users');
            $table->foreignId('delegated_id')->constrained('users');
            $table->foreignId('group_id')->constrained('groups');
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('projects');
    }
}
