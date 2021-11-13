<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number');
            $table->string('file')->nullable();
            $table->string('comment_reason')->nullable();
            $table->foreignId('requester_id')->constrained('users');
            $table->foreignId('sector_id')->constrained('sectors');
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->foreignId('project_id')->nullable()->constrained('projects');
            $table->foreignId('site_id')->nullable()->constrained('sites');
            $table->foreignId('group_id')->constrained('groups');
            $table->boolean('approved')->default(0);
            $table->boolean('sent')->default(0);
            $table->timestamps();
            $table->softDeletes();
            // cycle approve
            // $table->integer('userstepapproved_id')->nullable();
            // $table->integer('stepapproval_id')->nullable();
            // $table->string('approval_name')->nullable();
            // $table->integer('steprevert_id')->nullable();
            // $table->json('userstep_ids')->nullable();
            // $table->integer('approval_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_requests');
    }
}
