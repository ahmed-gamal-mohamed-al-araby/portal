<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalCycleApprovalStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_cycle_approval_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_cycle_id')->constrained('approval_cycles');
            $table->foreignId('approval_step_id')->constrained('approval_steps');
            $table->string('level', 2);
            $table->foreignId('next_id')->nullable()->constrained('approval_cycle_approval_steps');
            $table->foreignId('previous_id')->nullable()->constrained('approval_cycle_approval_steps');
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
        Schema::dropIfExists('approval_cycle_approval_steps');
    }
}
