<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project1Manager = User::create([
            'username' => 'project1.manager',
            'name_ar' => 'مدير مشروع1',
            'name_en' => 'Project1 Manager',
            'email' => 'project1.manager.fake@eecegypt.com',
            'code' => '9991',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير بمشروع 1',
            'position_en' => 'manager in project1',
            'sector_id' => 1,
        ]);

        $project = Project::create([
            'name_ar' => 'مشروع' . 1,
            'name_en' => 'Project' . 1,
            'description_ar' => 'وصف مشروع' . 1,
            'description_en' => 'Project' . 1 . 'description',
            'sector_id' => 1,
            'group_id' => 1, // Construction - Civil
            'manager_id' => $project1Manager->id,
            'delegated_id' => 1,
        ]);

        $project1Manager->update([
            'project_id' => $project->id,
        ]);

        // ///////////////////////////////////
        $project2Manager = User::create([
            'username' => 'project2.manager',
            'name_ar' => 'مدير مشروع2',
            'name_en' => 'Project2 Manager',
            'email' => 'project2.manager.fake@eecegypt.com',
            'code' => '9992',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير بمشروع 2',
            'position_en' => 'manager in project2',
            'sector_id' => 1,
        ]);

        $project = Project::create([
            'name_ar' => 'مشروع' . 1,
            'name_en' => 'Project' . 1,
            'description_ar' => 'وصف مشروع' . 1,
            'description_en' => 'Project' . 1 . 'description',
            'sector_id' => 1,
            'group_id' => 2, // Construction - MEP
            'manager_id' => $project2Manager->id,
            'delegated_id' => 1,
        ]);

        $project2Manager->update([
            'project_id' => $project->id,
        ]);

        // /////////////////////////////////////////

        for ($i = 2; $i <= 30; $i++) {
            $project = Project::create([
                'name_ar' => 'مشروع' . $i,
                'name_en' => 'Project' . $i,
                'description_ar' => 'وصف مشروع' . $i,
                'description_en' => 'Project' . $i . 'description',
                'sector_id' => ($i % 5) + 1,
                'manager_id' => ($i % 10) + 1,
                'delegated_id' => 1,
            ]);
        }

        User::where('code', 91000)->update([
            'sector_id' => 2,
            'project_id' => 1,
        ]);
    }
}
