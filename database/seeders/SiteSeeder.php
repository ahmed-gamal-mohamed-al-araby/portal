<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'name_ar' => 'موقع وادى النطرون',
            'name_en' => 'Wadi El Natrun site',
            'project_id' => 1,
        ]);

        Site::create([
            'name_ar' => 'موقع EJUST',
            'name_en' => 'EJUST site',
            'project_id' => 2,
        ]);

        Site::create([
            'name_ar' => 'موقع الكليات العسكرية',
            'name_en' => 'Military Colleges site',
            'project_id' => 3,
        ]);

        Site::create([
            'name_ar' => 'موقع الهايكستب',
            'name_en' => 'Haikstep site',
            'project_id' => 4,
        ]);

        Site::create([
            'name_ar' => 'موقع جامعة المنيا',
            'name_en' => 'Menia University site',
            'project_id' => 5,
        ]);

        Site::create([
            'name_ar' => 'موقع موبينيل',
            'name_en' => 'Mobinil site',
            'project_id' => 6,
        ]);

        Site::create([
            'name_ar' => 'موقع إتصالات',
            'name_en' => 'Etisalat site',
            'project_id' => 7,
        ]);
    }
}
