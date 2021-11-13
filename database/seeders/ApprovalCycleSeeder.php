<?php

namespace Database\Seeders;

use App\Models\ApprovalCycle;
use Illuminate\Database\Seeder;

class ApprovalCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* ----------------------------------------------------PERSONNEL FORMS-------------------------------------------------- */
        ApprovalCycle::create([
            'name_ar' => 'إذن إنصراف',
            'name_en' => 'Early Leave Permission',
            'code' => 'PER-01',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'إذن تأخير',
            'name_en' => 'Late Permission',
            'code' => 'PER-02',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'إذن مأموريه',
            'name_en' => 'Mission Permission',
            'code' => 'PER-03',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'طلب اجازة',
            'name_en' => 'Vacation Request',
            'code' => 'PER-04',
        ]);
        // END PERSONNEL FORMS

        /* ----------------------------------------------------IT FORMS-------------------------------------------------- */
        ApprovalCycle::create([
            'name_ar' => 'طلب من قسم تكنولوجيا المعلومات ',
            'name_en' => 'IT Change Request', //
            'code' => 'IT-01',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'إذن الاستثناء',
            'name_en' => 'Exception Permission',
            'code' => 'IT-02',
        ]);
        // END IT FORMS

        /* ----------------------------------------------------HR FORMS-------------------------------------------------- */
        ApprovalCycle::create([
            'name_ar' => 'طلب توظيف',
            'name_en' => 'Hiring Request',
            'code' => 'HR-01',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'نقل موظف',
            'name_en' => 'Employee Transfer',
            'code' => 'HR-02',
        ]);
        // END HR FORMS

        /* ----------------------------------------------------PROJECT-------------------------------------------------- */

        ApprovalCycle::create([
            'name_ar' => 'طلب شراء لمشروع (البناء - المدني)',
            'name_en' => 'Project Purchasing Request (Construction - Civil)',
            'code' => 'C_Civil',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'طلب شراء لمشروع (البناء - الهندسة الكهربائية والميكانيكية)',
            'name_en' => 'Project Purchasing Request (Construction - MEP)',
            'code' => 'C_MEP',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'طلب شراء لمشروع (Stationary)',
            'name_en' => 'Project Purchasing Request (Stationary)',
            'code' => 'stationary',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'طلب شراء لمشروع (تكنولوجيا المعلومات)',
            'name_en' => 'Project Purchasing Request (IT)',
            'code' => 'IT',
        ]);

        ApprovalCycle::create([
            'name_ar' => 'طلب شراء لمشروع (المكاتب)',
            'name_en' => 'Project Purchasing Request (Desks)',
            'code' => 'desks',
        ]);
    }
}
