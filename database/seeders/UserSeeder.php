<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'web.team',
            'name_ar' => 'فريق الويب',
            'name_en' => 'Web Team',
            'email' => 'web.team@eecegypt.com',
            'code' => '0001-000',
            'password' => bcrypt('123456'),
            // 'sector_id' => Sector::where('name_en', 'Corporate Planning & Development')->first()->id,
            // 'department_id' => Department::where('name_en', 'Information Technology (IT)')->first()->id,
        ]);

        // for ($i = 1; $i <= 100; $i++) {
        //     User::create([
        //         'username' => 'employee' . $i . 'user',
        //         'name_ar' => 'موظف' . $i,
        //         'name_en' => 'Employee' . $i,
        //         'email' => 'employee' . $i . '.fake@eecegypt.com',
        //         'code' => '11' . str_pad($i, 3, '0', STR_PAD_LEFT),
        //         'password' => bcrypt('123456'),
        //     ]);
        // }
    }
}
