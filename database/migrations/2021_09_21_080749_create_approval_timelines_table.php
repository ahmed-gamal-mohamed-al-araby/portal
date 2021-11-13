<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_timelines', function (Blueprint $table) {
            $table->id();
            $table->string('table_name', 255);
            $table->bigInteger('record_id');
            $table->foreignId('approval_cycle_approval_step_id')->constrained('approval_cycle_approval_steps');
            $table->enum('approval_status', ['P', 'A', 'RV', 'RJ'])->default('P')->comment('P: Pending, A: Approved, RV: Revert, RJ: Reject');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('approval_timelines');
    }
}
