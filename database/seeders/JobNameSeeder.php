<?php

namespace Database\Seeders;

use App\Models\JobName;
use Illuminate\Database\Seeder;

class JobNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start IT Grades
        JobName::create([
            'name_ar' => 'أخصائي تكنولوجيا المعلومات المبتدئ',
            'name_en' => 'Junior IT Specialist',
            'job_code_id' => 1,
        ]);

        JobName::create([
            'name_ar' => 'متخصص في تكنولوجيا المعلومات',
            'name_en' => 'IT Specialist',
            'job_code_id' => 2,
        ]);

        JobName::create([
            'name_ar' => 'أخصائي أول في تكنولوجيا المعلومات',
            'name_en' => 'Senior IT Specialist',
            'job_code_id' => 3,
        ]);

        JobName::create([
            'name_ar' => 'قائد فريق تكنولوجيا المعلومات',
            'name_en' => 'IT Team Leader',
            'job_code_id' => 4,
        ]);

        JobName::create([
            'name_ar' => 'مدير مساعد تكنولوجيا المعلومات',
            'name_en' => 'IT Assistant Manager',
            'job_code_id' => 5,
        ]);

        JobName::create([
            'name_ar' => 'مدير تكنولوجيا المعلومات',
            'name_en' => 'IT Manager',
            'job_code_id' => 6,
        ]);

        JobName::create([
            'name_ar' => 'مدير أول لتكنولوجيا المعلومات',
            'name_en' => 'Senior IT Manager',
            'job_code_id' => 7,
        ]);
        // End  IT Grades

        // Start Purchasing Grades
        // JobName::create([
        //     'name_ar' => 'كاتب مشتريات مبتدئ',
        //     'name_en' => 'Junior Purchasing clerk',
        //     'job_code_id' => 8,
        // ]);

        // JobName::create([
        //     'name_ar' => 'محاسب مشتريات مبتدئ',
        //     'name_en' => 'Junior Purchasing Accountant',
        //     'job_code_id' => 8,
        // ]);

        // JobName::create([
        //     'name_ar' => 'كاتب الشرائية',
        //     'name_en' => 'Purchasing clerk',
        //     'job_code_id' => 9,
        // ]);

        // JobName::create([
        //     'name_ar' => 'محاسب مشتريات',
        //     'name_en' => 'Purchasing Accountant',
        //     'job_code_id' => 9,
        // ]);

        // JobName::create([
        //     'name_ar' => 'كاتب مشتريات أول',
        //     'name_en' => 'Senior Purchasing clerk',
        //     'job_code_id' => 10,
        // ]);

        // JobName::create([
        //     'name_ar' => 'محاسب مشتريات أول',
        //     'name_en' => 'Senior Purchasing Accountant',
        //     'job_code_id' => 10,
        // ]);

        // JobName::create([
        //     'name_ar' => 'رئيس قسم المشتريات',
        //     'name_en' => 'Purchasing Section Head',
        //     'job_code_id' => 11,
        // ]);

        // JobName::create([
        //     'name_ar' => 'مدير مساعد المشتريات',
        //     'name_en' => 'Purchasing Assistant Manager',
        //     'job_code_id' => 11,
        // ]);

        // JobName::create([
        //     'name_ar' => 'مدير مشتريات',
        //     'name_en' => 'Purchasing Manager',
        //     'job_code_id' => 12,
        // ]);

        // JobName::create([
        //     'name_ar' => 'مدير مشتريات أول',
        //     'name_en' => 'Senior Purchasing Manager',
        //     'job_code_id' => 13,
        // ]);

        // JobName::create([
        //     'name_ar' => 'مدير المشتريات',
        //     'name_en' => 'Purchasing Director',
        //     'job_code_id' => 14,
        // ]);

        // JobName::create([
        //     'name_ar' => 'مدير مشتريات أول',
        //     'name_en' => 'Senior Purchasing Director',
        //     'job_code_id' => 15,
        // ]);
        // End  Purchasing Grades
    }
}
