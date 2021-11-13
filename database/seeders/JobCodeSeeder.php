<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\JobCode;
use Illuminate\Database\Seeder;

class JobCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start IT Department
        for ($i = 1; $i <= 8; $i++) {
            JobCode::create([
                'code' => 'IT' . $i,
                'department_id' => Department::where('name_en', 'Information Technology (IT)')->first()->id,
            ]);
        }
        // End IT Department

        // Start Purchasing Department
        // for ($i = 1; $i <= 8; $i++) {
        //     JobCode::create([
        //         'code' => 'FA' . $i,
        //         'department_id' => 11,
        //     ]);
        // }
        // End Purchasing Department

    }
}
