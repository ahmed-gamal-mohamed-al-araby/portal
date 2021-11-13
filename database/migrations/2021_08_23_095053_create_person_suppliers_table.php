<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('job', 255)->nullable();
            $table->string('mobile', 16)->nullable();
            $table->string('whatsapp', 16)->nullable();
            $table->string('email', 255)->nullable();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_suppliers');
    }
}
