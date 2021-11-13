<?php

namespace App\Observers;

use App\Models\FamilyName;
use App\Models\Group;
use App\Models\SubGroup;

class FamilyNameObserver
{
    /**
     * Handle the FamilyName "created" event.
     *
     * @param  \App\Models\FamilyName  $familyName
     * @return void
     */
    public function created(FamilyName $familyName)
    {
        if ($familyName->subGroup->group->code == 'C_CivilMEP') {
            $familyNameCivil = FamilyName::create([
                'name_ar' => $familyName->name_ar,
                'name_en' => $familyName->name_en,
                'sub_group_id' => SubGroup::where('name_en', $familyName->subGroup->name_en)
                    ->where('group_id', Group::where('code', 'C_Civil')->first()->id)
                    ->first()->id,
                'both' => 1,
            ]);

            $familyNameMEP = FamilyName::create([
                'name_ar' => $familyName->name_ar,
                'name_en' => $familyName->name_en,
                'sub_group_id' => 1,
                'both' => 1,
            ]);
        }
    }

    /**
     * Handle the FamilyName "updated" event.
     *
     * @param  \App\Models\FamilyName  $familyName
     * @return void
     */
    public function updated(FamilyName $familyName)
    {
        //
    }

    /**
     * Handle the FamilyName "deleted" event.
     *
     * @param  \App\Models\FamilyName  $familyName
     * @return void
     */
    public function deleted(FamilyName $familyName)
    {
        //
    }

    /**
     * Handle the FamilyName "restored" event.
     *
     * @param  \App\Models\FamilyName  $familyName
     * @return void
     */
    public function restored(FamilyName $familyName)
    {
        //
    }

    /**
     * Handle the FamilyName "force deleted" event.
     *
     * @param  \App\Models\FamilyName  $familyName
     * @return void
     */
    public function forceDeleted(FamilyName $familyName)
    {
        //
    }
}
