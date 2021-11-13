<?php

namespace Database\Seeders;

use App\Models\ApprovalCycle;
use App\Models\ApprovalCycleApprovalStep;
use App\Models\ApprovalStep;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApprovalCycleApprovalStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectManagerStepID = ApprovalStep::where('code', 'PRO_M')->first()->id;
        $sectorHeadStepID = ApprovalStep::where('code', 'SEC_H')->first()->id;
        $purchasingSectorHeadStepID = ApprovalStep::where('code', 'PUR_H')->first()->id;
        $CEOSectorHeadStepID = ApprovalStep::where('code', 'CEO_H')->first()->id;
        $TechnicalOfficeCivilDepartmentManagerStepID = ApprovalStep::where('code', 'TEC_OFF_Civil')->first()->id;
        $TechnicalOfficeMEPDepartmentManagerStepID = ApprovalStep::where('code', 'TEC_OFF_MEP')->first()->id;

        $DepartmentManagerStepID = ApprovalStep::where('code', 'DEP_M')->first()->id;
        $Pln_HStepID = ApprovalStep::where('code', 'Pln_H')->first()->id;

        $PRConstructionITID = ApprovalCycle::where('code', 'IT')->first()->id;
        $PRConstructionCivilID = ApprovalCycle::where('code', 'C_Civil')->first()->id;
        $PRConstructionMEPID = ApprovalCycle::where('code', 'C_MEP')->first()->id;
        // $PRStationaryID = ApprovalCycle::where(['code', 'stationary'])->first()->id;
        // $PRITID = ApprovalCycle::where(['code', 'IT'])->first()->id;
        // $PRDesksID = ApprovalCycle::where(['code', 'desks'])->first()->id;

        // Start PRConstructionCivil
        // Step1 (Project Manager)
        $PRConstructionCivilProjectManager = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionCivilID,
            'approval_step_id' => $projectManagerStepID,
            'level' => '1',
            'previous_id' => null
            // 'next_id' => '',
        ]);
        // Step2 (Sector Head)
        $PRConstructionCivilSectorHead = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionCivilID,
            'approval_step_id' => $sectorHeadStepID,
            'level' => '2',
            'previous_id' => $PRConstructionCivilProjectManager->id
        ]);

        // Step3 (Technical Office depend on group)
        $PRConstructionCivilTechinicalOffice = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionCivilID,
            'approval_step_id' => $TechnicalOfficeCivilDepartmentManagerStepID,
            'level' => '3',
            'previous_id' => $PRConstructionCivilProjectManager->id
        ]);


        // Step4 (Purchasing Section Head)
        $PRConstructionCivilPurchasing = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionCivilID,
            'approval_step_id' => $purchasingSectorHeadStepID,
            'level' => '4',
            'previous_id' => $PRConstructionCivilSectorHead->id
        ]);

        // Step5 (CEO)
        $PRConstructionCivilCEO = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionCivilID,
            'approval_step_id' => $CEOSectorHeadStepID,
            'level' => '5',
            'previous_id' => $PRConstructionCivilSectorHead->id
        ]);


        // Step1 (Project Manager) Next
        $PRConstructionCivilProjectManager->update([
            'next_id' => $PRConstructionCivilSectorHead->id
        ]);
        // Step2 (Sector Head) Next
        $PRConstructionCivilSectorHead->update([
            'next_id' => $PRConstructionCivilTechinicalOffice->id
        ]);
        // Step3 (Technical Office depend on group) Next
        $PRConstructionCivilTechinicalOffice->update([
            'next_id' => $PRConstructionCivilPurchasing->id
        ]);
        // Step4 (Purchasing Section Head) Next
        $PRConstructionCivilPurchasing->update([
            'next_id' => $PRConstructionCivilCEO->id
        ]);
        // End PRConstructionCivil
        //  -------------------------------------------------------------------------------------------------  //

        // // Start PRConstructionMEPID
        // Step1 (Project Manager)
        $PRConstructionMEPProjectManager = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionMEPID,
            'approval_step_id' => $projectManagerStepID,
            'level' => '1',
            'previous_id' => null
            // 'next_id' => '',
        ]);
        // Step2 (Sector Head)
        $PRConstructionMEPSectorHead = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionMEPID,
            'approval_step_id' => $sectorHeadStepID,
            'level' => '2',
            'previous_id' => $PRConstructionMEPProjectManager->id
        ]);

        // Step3 (Technical Office depend on group)
        $PRConstructionMEPTechinicalOffice = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionMEPID,
            'approval_step_id' => $TechnicalOfficeMEPDepartmentManagerStepID,
            'level' => '3',
            'previous_id' => $PRConstructionMEPProjectManager->id
        ]);


        // Step4 (Purchasing Section Head)
        $PRConstructionMEPPurchasing = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionMEPID,
            'approval_step_id' => $purchasingSectorHeadStepID,
            'level' => '4',
            'previous_id' => $PRConstructionMEPSectorHead->id
        ]);

        // Step5 (CEO)
        $PRConstructionMEPCEO = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionMEPID,
            'approval_step_id' => $CEOSectorHeadStepID,
            'level' => '5',
            'previous_id' => $PRConstructionMEPSectorHead->id
        ]);


        // Step1 (Project Manager) Next
        $PRConstructionMEPProjectManager->update([
            'next_id' => $PRConstructionMEPSectorHead->id
        ]);
        // Step2 (Sector Head) Next
        $PRConstructionMEPSectorHead->update([
            'next_id' => $PRConstructionMEPTechinicalOffice->id
        ]);
        // Step3 (Technical Office depend on group) Next
        $PRConstructionMEPTechinicalOffice->update([
            'next_id' => $PRConstructionMEPPurchasing->id
        ]);
        // Step4 (Purchasing Section Head) Next
        $PRConstructionMEPPurchasing->update([
            'next_id' => $PRConstructionMEPCEO->id
        ]);
        // End PRConstructionCivil
        // // End PRConstructionMEPID

         // // Start IT
        // Step1 (Department manager)
        $PRConstructionDepartmentManager = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionITID,
            'approval_step_id' => $DepartmentManagerStepID,
            'level' => '1',
            'previous_id' => null
            // 'next_id' => '',
        ]);
        // Step2 (PLN_H Head)
        $PRConstructionPLN_HSectorHead = ApprovalCycleApprovalStep::create([
            'approval_cycle_id' => $PRConstructionITID,
            'approval_step_id' => $Pln_HStepID,
            'level' => '2',
            'previous_id' => $PRConstructionDepartmentManager->id
        ]);


        // Step1 (Project Manager) Next
        $PRConstructionDepartmentManager->update([
            'next_id' => $PRConstructionPLN_HSectorHead->id
        ]);
 
        // End IT
        // // End IT
    }
}
