<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name_ar' => 'البناء - المدني',
            'name_en' => 'Construction - Civil',
            'code' => 'C_Civil'
        ]);

        Group::create([
            'name_ar' => 'البناء - الهندسة الكهربائية والميكانيكية',
            'name_en' => 'Construction - MEP',
            'code' => 'C_MEP'
        ]);

        Group::create([
            'name_ar' => 'البناء - المدني & الهندسة الكهربائية والميكانيكية',
            'name_en' => 'Construction - Civil & MEP',
            'code' => 'C_CivilMEP',
            'both' => 1,
        ]);

        Group::create([
            'name_ar' => 'تكنولوجيا المعلومات',
            'name_en' => 'IT',
            'code' => 'IT'
        ]);

        Group::create([
            'name_ar' => 'Stationary Ar',
            'name_en' => 'Stationary',
            'code' => 'stationary'
        ]);

        Group::create([
            'name_ar' => 'المكاتب',
            'name_en' => 'Desks',
            'code' => 'desks'
        ]);

        // for ($i = 0; $i < 5; $i++) {
        //     Group::create([
        //         'name_ar' => 'مجموعة' . ($i + 1),
        //         'name_en' => 'Group' . ($i + 1),
        //         'code' => 'C_C'
        //     ]);
        // }
    }
}
