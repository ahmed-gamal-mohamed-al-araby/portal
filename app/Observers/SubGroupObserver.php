<?php

namespace App\Observers;

use App\Models\FamilyName;
use App\Models\Group;
use App\Models\SubGroup;
use Illuminate\Support\Facades\Log;

class SubGroupObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the SubGroup "created" event.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return void
     */
    public function created(SubGroup $subGroup)
    {
        if ($subGroup->group->code == 'C_CivilMEP') {
            $subGroupCivil = SubGroup::create([
                'name_ar' => $subGroup->name_ar,
                'name_en' => $subGroup->name_en,
                'group_id' => Group::where('code', 'C_Civil')->first()->id,
                'both' => 1,
            ]);
            $subGroupMEP = SubGroup::create([
                'name_ar' => $subGroup->name_ar,
                'name_en' => $subGroup->name_en,
                'group_id' => Group::where('code', 'C_MEP')->first()->id,
                'both' => 1,
            ]);
            Log::info('Create Construction - Civil & MEP Group => ' . json_encode($subGroup));
            Log::info('Create Construction Civil Group => ' . json_encode($subGroupCivil));
            Log::info('Create Construction MEP Group => ' . json_encode($subGroupMEP));
        }
    }

    /**
     * Handle the SubGroup "updated" event.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return void
     */
    public function updated(SubGroup $subGroup)
    {
    }

    /**
     * Handle the SubGroup "deleted" event.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return void
     */
    public function deleted(SubGroup $subGroup)
    {
        if ($subGroup->group->code == 'C_CivilMEP') {
            Log::info('Delete Construction - Civil & MEP Group => ' . json_encode($subGroup));
            $subGroupCivil = SubGroup::where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_Civil')->first()->id)->first();
            $subGroupMEP = SubGroup::where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_MEP')->first()->id)->first();

            if ($subGroupCivil) {
                $deletedsubGropCivil = clone $subGroupCivil;
                Log::info('Delete Construction Civil Group => ' . json_encode($deletedsubGropCivil));
                $subGroupCivil->delete();
            }

            if ($subGroupMEP) {
                $deletedsubGropMEP = clone $subGroupMEP;
                Log::info('Delete Construction MEP Group => ' . json_encode($deletedsubGropMEP));
                $subGroupMEP->delete();
            }
        }
    }

    /**
     * Handle the SubGroup "restored" event.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return void
     */
    public function restored(SubGroup $subGroup)
    {
        if ($subGroup->group->code == 'C_CivilMEP') {
            $subGroupCivil = SubGroup::withTrashed()->where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_Civil')->first()->id)->first();
            $subGroupMEP = SubGroup::withTrashed()->where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_MEP')->first()->id)->first();
            $subGroupCivil->restore();
            $subGroupMEP->restore();

            Log::info('Restore Construction - Civil & MEP Group => ' . json_encode($subGroup));
            Log::info('Restore Construction Civil Group => ' . json_encode($subGroupCivil));
            Log::info('Restore Construction MEP Group => ' . json_encode($subGroupMEP));
        }
    }

    /**
     * Handle the SubGroup "force deleted" event.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return void
     */
    public function forceDeleted(SubGroup $subGroup)
    {
        // Log::info('Permanent delete Construction - Civil & MEP Group => ' . json_encode($subGroup));

        // if ($subGroup->group->code == 'C_CivilMEP') {
        //     $subGroupCivil = SubGroup::onlyTrashed()->where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_Civil')->first()->id)->first();
        //     $subGroupMEP = SubGroup::onlyTrashed()->where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_MEP')->first()->id)->first();

        //     if ($subGroupCivil) {
        //         $deletedsubGropCivil = clone $subGroupCivil;
        //         Log::info('Permanent delete Construction Civil Group => ' . json_encode($deletedsubGropCivil));
        //         $subGroupCivil->forceDelete();
        //     }

        //     if ($subGroupMEP) {
        //         $deletedsubGropMEP = clone $subGroupMEP;
        //         Log::info('Permanent delete Construction MEP Group => ' . json_encode($deletedsubGropMEP));
        //         $subGroupMEP->forceDelete();
        //     }
        // }
    }
}
