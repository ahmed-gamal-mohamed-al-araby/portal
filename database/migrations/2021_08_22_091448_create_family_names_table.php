<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_names', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 355);
            $table->string('name_en', 355);
            $table->foreignId('sub_group_id')->constrained('sub_groups');
            $table->boolean('both')->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_names');
    }
}
