<?php

namespace Database\Seeders;

use App\Models\PurchaseRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class PurchaseRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectRequester = User::create([
            'username' => 'project1.employee1',
            'name_ar' => 'مشروع1 موظف1',
            'name_en' => 'Project1 Employee1',
            'email' => 'project1.employee1.fake@eecegypt.com',
            'code' => '999',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف بمشروع 1',
            'position_en' => 'employee in project1',
            'sector_id' => 13,
            'project_id' => 1,
            'board_member' => 1,
        ]);

        PurchaseRequest::create([
            'request_number' => date('Y') . '-' . str_pad(1, 4, '0', STR_PAD_LEFT),
            'requester_id' => $projectRequester->id,
            'sector_id' => 13,
            'department_id' => null,
            'project_id' => 1,
            'group_id' => 1,
            'site_id' => null,
        ]);

        $projectRequester = User::create([
            'username' => 'project1.employee2',
            'name_ar' => 'مشروع1 موظف2',
            'name_en' => 'Project1 Employee2',
            'email' => 'project1.employee2.fake@eecegypt.com',
            'code' => '888',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف2 بمشروع 1',
            'position_en' => 'employee2 in project1',
            'sector_id' => 13,
            'project_id' => 1,
            'board_member' => 1,
        ]);

        PurchaseRequest::create([
            'request_number' => date('Y') . '-' . str_pad(1, 4, '0', STR_PAD_LEFT),
            'requester_id' => $projectRequester->id,
            'sector_id' => 13,
            'department_id' => null,
            'project_id' => 1,
            'group_id' => 2,
            'site_id' => null,
        ]);


        // for ($i = 2; $i <= 30; $i++) {
        //     $department_id = ($i % 2) ? (($i % 10) ?  ($i % 10)  : ($i % 10) + 1)  : NULL;
        //     $project_id = $department_id ? NULL : $i;
        //     PurchaseRequest::create([
        //         'request_number' => date('Y') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
        //         'requester_id' => ($i % 10) + 1,
        //         'sector_id' => ($i % 5) + 1,
        //         'department_id' => $department_id,
        //         'project_id' => $project_id,
        //         'group_id' => 2,
        //         'site_id' => $project_id ? (($project_id * 3) <= 30 ? $project_id * 3 : NULL) : NULL,
        //     ]);
        // }
    }
}
