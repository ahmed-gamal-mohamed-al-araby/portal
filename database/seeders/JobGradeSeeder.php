<?php

namespace Database\Seeders;

use App\Models\JobGrade;
use Illuminate\Database\Seeder;

class JobGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start IT Grades
        for ($i = 29; $i >= 27; $i--) {
            JobGrade::create([
                'grade' => $i,
                'job_code_id' => 1,
            ]);
        }

        for ($i = 26; $i >= 22; $i--) {
            JobGrade::create([
                'grade' => $i,
                'job_code_id' => 2,
            ]);
        }

        for ($i = 21; $i >= 18; $i--) {
            JobGrade::create([
                'grade' => $i,
                'job_code_id' => 3,
            ]);
        }

        for ($i = 17; $i >= 13; $i--) {
            JobGrade::create([
                'grade' => $i,
                'job_code_id' => 4,
            ]);
        }

        for ($i = 12; $i >= 8; $i--) {
            JobGrade::create([
                'grade' => $i,
                'job_code_id' => 5,
            ]);
        }

        for ($i = 7; $i >= 4; $i--) {
            JobGrade::create([
                'grade' => $i,
                'job_code_id' => 6,
            ]);
        }

        for ($i = 3; $i >= 1; $i--) {
            JobGrade::create([
                'grade' => $i,
                'job_code_id' => 7,
            ]);
        }
        // End  IT Grades

        // Start Purchasing Grades
        // for ($i = 29; $i >= 28; $i--) {
        //     JobGrade::create([
        //         'grade' => $i,
        //         'job_code_id' => 8,
        //     ]);
        // }

        // for ($i = 27; $i >= 23; $i--) {
        //     JobGrade::create([
        //         'grade' => $i,
        //         'job_code_id' => 9,
        //     ]);
        // }

        // for ($i = 22; $i >= 19; $i--) {
        //     JobGrade::create([
        //         'grade' => $i,
        //         'job_code_id' => 10,
        //     ]);
        // }

        // for ($i = 18; $i >= 14; $i--) {
        //     JobGrade::create([
        //         'grade' => $i,
        //         'job_code_id' => 11,
        //     ]);
        // }

        // for ($i = 13; $i >= 10; $i--) {
        //     JobGrade::create([
        //         'grade' => $i,
        //         'job_code_id' => 12,
        //     ]);
        // }

        // for ($i = 9; $i >= 6; $i--) {
        //     JobGrade::create([
        //         'grade' => $i,
        //         'job_code_id' => 13,
        //     ]);
        // }

        // for ($i = 5; $i >= 4; $i--) {
        //     JobGrade::create([
        //         'grade' => $i,
        //         'job_code_id' => 14,
        //     ]);
        // }

        // for ($i = 3; $i >= 1; $i--) {
        //     JobGrade::create([
        //         'grade' => $i,
        //         'job_code_id' => 15,
        //     ]);
        // }
        // End  Purchasing Grades

    }
}
