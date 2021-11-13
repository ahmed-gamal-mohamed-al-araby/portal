<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_steps', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar', 255);
            $table->string('name_en', 255);
            $table->string('code', 100);
            $table->string('value', 255); // {"depth":[]", query":{"T":"tableName","CONs":[{"CN":"name_en"},{"CV":"COO"}],"depth":["first","head"]}}
            /*
            * depth array contain relations as $user->department->manager =======> "depth":['department', 'manager']
            * query object contain T: TableName, CONs: conditions
            * CONs array contain CN: ColumnName, CV: ColumnValue
            */
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
        Schema::dropIfExists('approval_steps');
    }
}
