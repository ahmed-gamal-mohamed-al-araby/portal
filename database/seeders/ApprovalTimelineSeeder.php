<?php

namespace Database\Seeders;

use App\Models\ApprovalTimeline;
use Illuminate\Database\Seeder;

class ApprovalTimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApprovalTimeline::create([
            'table_name' => 'ezn',
            'record_id' => '1',
            'approval_cycle_approval_step_id' => '1',
            'user_id' => '1',
        ]);

        ApprovalTimeline::create([
            'table_name' => 'zzz',
            'record_id' => '1',
            'approval_cycle_approval_step_id' => '4',
            'user_id' => '1',
        ]);
    }
}
