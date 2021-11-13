<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


/**
 * This trait for return approval cycles data
 */
trait ApprovalCycleTrait
{

    public function getModelFromClassName($tableName)
    {
        $modelName = Str::studly(Str::singular($tableName));
        return 'App\\Models\\' . $modelName;
    }
    /**
     * Retuen a listing of the approval cycle steps.
     *
     * @return array
     */
    public function getApprovalCycleSteps($approvalCycleId)
    {
        return DB::table('approval_cycles')->where('approval_cycles.id', $approvalCycleId)
            ->join('approval_cycle_approval_steps', 'approval_cycles.id', '=', 'approval_cycle_approval_steps.approval_cycle_id')
            ->join('approval_steps', 'approval_steps.id', '=', 'approval_cycle_approval_steps.approval_step_id')
            ->select('approval_steps.name_ar', 'approval_steps.name_en')
            ->get();
    }

    /**
     * Retuen a listing of the timeline steps.
     *
     * @return array
     */
    public function getApprovalCycleTimelines($tableName, $recordId)
    {
        return DB::table('approval_timelines')->where('table_name', $tableName)->where('record_id', $recordId)
            ->join('users', 'users.id', '=', 'approval_timelines.user_id')
            ->join('approval_cycle_approval_steps', 'approval_cycle_approval_steps.id', '=', 'approval_timelines.approval_cycle_approval_step_id')
            ->join('approval_steps', 'approval_steps.id', '=', 'approval_cycle_approval_steps.approval_step_id')
            ->leftJoin('approval_timeline_comments', 'approval_timeline_comments.approval_timeline_id', '=', 'approval_timelines.id')
            ->select('approval_steps.name_ar as AS_name_ar', 'approval_steps.name_en  as AS_name_en', 'users.name_ar as U_name_ar', 'users.name_en as U_name_en',  'approval_timelines.updated_at', 'approval_timelines.approval_status', 'approval_timeline_comments.comment as comment')
            ->orderBy('updated_at')->get();
    }

    /**
     * Retuen a listing of pending approval for current authenticated user.
     *
     * @return array
     */
    public function getCurrentUserPendingApprovals()
    {
        return DB::table('approval_timelines')
            ->join('approval_cycle_approval_steps', 'approval_cycle_approval_steps.id', '=', 'approval_timelines.approval_cycle_approval_step_id')
            ->join('users', 'users.id', '=', 'approval_timelines.user_id')
            ->join('approval_steps', 'approval_steps.id', '=', 'approval_cycle_approval_steps.approval_step_id')
            ->where('approval_timelines.user_id', auth()->user()->id)
            ->where('approval_timelines.approval_status', 'P')
            ->select('approval_timelines.id', 'approval_cycle_approval_steps.level', 'users.username', 'approval_timelines.table_name', 'approval_timelines.approval_status', 'approval_steps.name_ar', 'approval_steps.name_en')
            ->orderBy('approval_timelines.updated_at')->get();
    }

    /**
     * Retuen a data from database based on table name and condition.
     *
     * @return array
     */
    public function getComplexNextUserForApprovals($tableName, $conditions, $depths)
    {
        $firstCodition = $conditions[0];

        array_shift($conditions); // remove first condition

        $model = $this->getModelFromClassName($tableName);
        $returnedData = $model::where($firstCodition->CN, $firstCodition->CV); // CN => columnName, CV=> columnValue

        foreach ($conditions as $condition) {
            $returnedData = $returnedData->where($condition->CN, $condition->CV);
        }

        foreach ($depths as $step) {
            $stepLength = strlen($step);
            if ($step[$stepLength - 2] == '(' && $step[$stepLength - 1] == ')') // check if i will call method not property
                $returnedData = $returnedData->{substr($step, 0, $stepLength - 2)}();
            else
                $returnedData = $returnedData->{$step};
        }
        return $returnedData;
    }

    /**
     * Retuen a data after depth relation.
     *
     * @return array
     */
    /*
        public function getDataAfterDepthRelation($tableName, $conditions, $firstOnly = false)
        {
        }
    */

    /**
     * Retuen a listing of the table record timelines.
     *
     * @return array
     */
    /*
        public function getTableRecordApprovalTimelines($tableName, $recordId)
        {
            return DB::table('approval_timelines')
                ->join('approval_cycle_approval_steps', 'approval_cycle_approval_steps.id', '=', 'approval_timelines.approval_cycle_approval_step_id')
                ->join('users', 'users.id', '=', 'approval_timelines.user_id')
                ->where('approval_timelines.table_name', $tableName)
                ->where('approval_timelines.record_id', $recordId)
                ->select('approval_timelines.id', 'approval_cycle_approval_steps.level', 'users.username', 'approval_timelines.table_name', 'approval_timelines.approval_status')
                ->orderBy('approval_timelines.updated_at')->get();
        }
    */
}
