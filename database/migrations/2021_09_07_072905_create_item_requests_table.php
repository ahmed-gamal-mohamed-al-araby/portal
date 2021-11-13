<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_request_id')->constrained('purchase_requests')->onDelete('cascade');
            $table->foreignId('family_name_id')->constrained('family_names');
            $table->text('specification');

            $table->integer('quantity');
            $table->integer('stock_quantity');
            $table->integer('actual_quantity');

            $table->foreignId('unit_id')->constrained('units');
            $table->enum('priority',['L', 'M', 'H'])->comment('L: Low, M: Medium, H: High');

            $table->text('comment')->nullable();
            $table->boolean('approved')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_requests');
    }
}
