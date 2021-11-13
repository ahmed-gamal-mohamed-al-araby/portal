<?php

namespace Database\Seeders;

use App\Models\FamilyName;
use Illuminate\Database\Seeder;

class FamilyNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FamilyName::create([
            'name_ar' => 'حديد تسليح أقطار متنوعة',
            'name_en' => 'Rebar of various diameters',
            'sub_group_id' => 1,
        ]);

        FamilyName::create([
            'name_ar' => 'أسمنت + جبس بأنواعهم',
            'name_en' => 'Cement + gypsum of all kinds',
            'sub_group_id' => 1,
        ]);

        FamilyName::create([
            'name_ar' => 'عزل رطوبة + منشآت مائية بأنواعهم',
            'name_en' => 'Moisture insulation + water installations of all kinds',
            'sub_group_id' => 1,
        ]);

        FamilyName::create([
            'name_ar' => 'عزل حرارة',
            'name_en' => 'heat insulation',
            'sub_group_id' => 1,
        ]);

        FamilyName::create([
            'name_ar' => 'حماية عزل',
            'name_en' => 'insulation protection',
            'sub_group_id' => 1,
        ]);

        FamilyName::create([
            'name_ar' => 'بلوك + طوب أسمنتي بأنواعها',
            'name_en' => 'Block + cement bricks of all kinds',
            'sub_group_id' => 1,
        ]);

        FamilyName::create([
            'name_ar' => 'بردورات + إنترلوك بأنواعه',
            'name_en' => 'Borders + all kinds of interlocks',
            'sub_group_id' => 1,
        ]);

        FamilyName::create([
            'name_ar' => 'كيماويات بناء + إضافات للخرسانة بأنواعها',
            'name_en' => 'Building chemicals + additives for all kinds of concrete',
            'sub_group_id' => 1,
        ]);

        // ----------------

        FamilyName::create([
            'name_ar' => 'دهانات إيبوكسية',
            'name_en' => 'epoxy paints',
            'sub_group_id' => 2,
        ]);

        FamilyName::create([
            'name_ar' => 'دهانات بلاستيك بأنواعها + معجون',
            'name_en' => 'Plastic paints of all kinds + putty',
            'sub_group_id' => 2,
        ]);

        FamilyName::create([
            'name_ar' => 'دهانات أسمنتية',
            'name_en' => 'cement paints',
            'sub_group_id' => 2,
        ]);

        FamilyName::create([
            'name_ar' => 'كرانيش فيوتك + اللاصق',
            'name_en' => 'Futech crunchy + adhesive',
            'sub_group_id' => 2,
        ]);

        FamilyName::create([
            'name_ar' => 'سيراميك حوائط + أرضيات بأنواعه',
            'name_en' => 'Ceramic walls + floors of all kinds',
            'sub_group_id' => 2,
        ]);

        FamilyName::create([
            'name_ar' => 'بلاط متنوع شامل الوزر',
            'name_en' => 'Assorted tiles, including all sizes',
            'sub_group_id' => 2,
        ]);

        FamilyName::create([
            'name_ar' => 'رخام بأنواعه',
            'name_en' => 'All kinds of marble',
            'sub_group_id' => 2,
        ]);

        FamilyName::create([
            'name_ar' => 'مرابات',
            'name_en' => 'Marbat',
            'sub_group_id' => 2,
        ]);

        // ---------

        FamilyName::create([
            'name_ar' => 'مواسير حديد سيملس',
            'name_en' => 'Seamless iron pipes',
            'sub_group_id' => 3,
        ]);

        FamilyName::create([
            'name_ar' => 'وصلات خطوط مكافحة حريق - Grooved',
            'name_en' => 'Fire Fighting Line Joints - Grooved',
            'sub_group_id' => 3,
        ]);

        FamilyName::create([
            'name_ar' => 'وصلات خطوط مكافحة حريق - لحام',
            'name_en' => 'Fire Fighting Lines Connections - Welding',
            'sub_group_id' => 3,
        ]);

        FamilyName::create([
            'name_ar' => 'كابينة مكافحة حريق + إكسسوارات متنوعة',
            'name_en' => 'Fire fighting cabin + various accessories',
            'sub_group_id' => 3,
        ]);

        FamilyName::create([
            'name_ar' => 'نظام إطفاء حريق بالغازات',
            'name_en' => 'Gas fire extinguishing system',
            'sub_group_id' => 3,
        ]);

        FamilyName::create([
            'name_ar' => 'مواسير EMT + إكسسواراتها',
            'name_en' => 'EMT Pipes + Accessories',
            'sub_group_id' => 3,
        ]);

        // --------------

        FamilyName::create([
            'name_ar' => 'مواسير كهرباء + إكسسواراتها',
            'name_en' => 'Electrical pipes + accessories',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'أسلاك متنوعة',
            'name_en' => 'Various wires',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'كابلات نحاس',
            'name_en' => 'copper cables',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'كابلات ألومنيوم',
            'name_en' => 'aluminum cables',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'كابلات سماعات + تليفون + كنترول',
            'name_en' => 'Headphones + phone + control cables',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'كشافات ولوازمها',
            'name_en' => 'Headlights and accessories',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'لقم كهرباء + مفاتيح + أوجه',
            'name_en' => 'Electric bits + switches + faces',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'أجهزة كهربائية',
            'name_en' => 'Electrical devices',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'قواطع تيار بأنواعها',
            'name_en' => 'All kinds of circuit breakers',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'حوامل كابلات بأنواعها وإكسسواراتها',
            'name_en' => 'Cable holders of all kinds and accessories',
            'sub_group_id' => 4,
        ]);

        FamilyName::create([
            'name_ar' => 'أعمدة إنارة',
            'name_en' => 'lampposts',
            'sub_group_id' => 4,
        ]);

        // --------

        FamilyName::create([
            'name_ar' => 'مواسير تغذية بولي بروبيلين PR + وصلاتها',
            'name_en' => 'PR Polypropylene Feeding Pipes + Fittings',
            'sub_group_id' => 5,
        ]);

        FamilyName::create([
            'name_ar' => 'مواسير UPVC + وصلات',
            'name_en' => 'UPVC Pipes + Couplings',
            'sub_group_id' => 5,
        ]);

        FamilyName::create([
            'name_ar' => 'مواسير HDPE + وصلات',
            'name_en' => 'HDPE pipes + fittings',
            'sub_group_id' => 5,
        ]);

        FamilyName::create([
            'name_ar' => 'طلمبات مياه',
            'name_en' => 'water pumps',
            'sub_group_id' => 5,
        ]);

        FamilyName::create([
            'name_ar' => 'أجهزة صحية',
            'name_en' => 'health appliances',
            'sub_group_id' => 5,
        ]);

        FamilyName::create([
            'name_ar' => 'غرف ولوازم صرف + إكسسواراتها',
            'name_en' => 'Rooms and exchange supplies + accessories',
            'sub_group_id' => 5,
        ]);

        // ---------

        FamilyName::create([
            'name_ar' => 'أمن وسلامة',
            'name_en' => 'Security and safety',
            'sub_group_id' => 6,
        ]);

        FamilyName::create([
            'name_ar' => 'كرفانات + أثاث + معدات إعاشة',
            'name_en' => 'Caravans + furniture + catering equipment',
            'sub_group_id' => 6,
        ]);

        FamilyName::create([
            'name_ar' => 'أجهزة مساحية بمشتملاتها',
            'name_en' => 'Surveying equipment and its contents',
            'sub_group_id' => 6,
        ]);

        // -----------

        FamilyName::create([
            'name_ar' => 'سلك شبك للمباني',
            'name_en' => 'wire mesh for buildings',
            'sub_group_id' => 7,
        ]);

        FamilyName::create([
            'name_ar' => 'باك رود',
            'name_en' => 'Back Road',
            'sub_group_id' => 7,
        ]);

        FamilyName::create([
            'name_ar' => 'سلك رباط',
            'name_en' => 'Wire bond',
            'sub_group_id' => 7,
        ]);

        FamilyName::create([
            'name_ar' => 'بسكوت خرسانة',
            'name_en' => 'concrete biscuits',
            'sub_group_id' => 7,
        ]);

        FamilyName::create([
            'name_ar' => 'ستيل فايبر',
            'name_en' => 'steel fiber',
            'sub_group_id' => 7,
        ]);

        // for ($i = 0; $i < 30; $i++) {
        //     FamilyName::create([
        //         'name_ar' => '__عائلة' . ($i + 1),
        //         'name_en' => 'Family' . ($i + 1),
        //         'sub_group_id' => ($i % 10) + 1,
        //     ]);
        // }
    }
}
