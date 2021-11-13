<?php

namespace Database\Seeders;

use App\Models\Governorate;
use App\Models\Country;
use Illuminate\Database\Seeder;

class Country_GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'code' => 'AF',
            'name_ar' => 'افغانستان',
            'name_en' => 'Afghanistan',
            'phone_code' => 93,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AL',
            'name_ar' => 'البانيا',
            'name_en' => 'Albania',
            'phone_code' => 355,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'DZ',
            'name_ar' => 'الجزائر',
            'name_en' => 'Algeria',
            'phone_code' => 213,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AS',
            'name_ar' => 'American Samoa',
            'name_en' => 'American Samoa',
            'phone_code' => 1684,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AD',
            'name_ar' => 'اندورا',
            'name_en' => 'Andorra',
            'phone_code' => 376,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AO',
            'name_ar' => 'انجولا',
            'name_en' => 'Angola',
            'phone_code' => 244,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AI',
            'name_ar' => 'Anguilla',
            'name_en' => 'Anguilla',
            'phone_code' => 1264,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AQ',
            'name_ar' => 'Antarctica',
            'name_en' => 'Antarctica',
            'phone_code' => 0,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AG',
            'name_ar' => 'انتيجوا وباربودا	',
            'name_en' => 'Antigua And Barbuda',
            'phone_code' => 1268,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AR',
            'name_ar' => 'الارجنتين',
            'name_en' => 'Argentina',
            'phone_code' => 54,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AM',
            'name_ar' => 'ارمينيا',
            'name_en' => 'Armenia',
            'phone_code' => 374,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AW',
            'name_ar' => 'Aruba',
            'name_en' => 'Aruba',
            'phone_code' => 297,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AU',
            'name_ar' => 'استراليا',
            'name_en' => 'Australia',
            'phone_code' => 61,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AT',
            'name_ar' => 'النمسا',
            'name_en' => 'Austria',
            'phone_code' => 43,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AZ',
            'name_ar' => 'اذربيجان',
            'name_en' => 'Azerbaijan',
            'phone_code' => 994,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BS',
            'name_ar' => 'جزر البهاما',
            'name_en' => 'Bahamas The',
            'phone_code' => 1242,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BH',
            'name_ar' => 'البحرين',
            'name_en' => 'Bahrain',
            'phone_code' => 973,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BD',
            'name_ar' => 'بنجلاديش',
            'name_en' => 'Bangladesh',
            'phone_code' => 880,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BB',
            'name_ar' => 'باربادوس',
            'name_en' => 'Barbados',
            'phone_code' => 1246,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BY',
            'name_ar' => 'بيلا روسيا',
            'name_en' => 'Belarus',
            'phone_code' => 375,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BE',
            'name_ar' => 'بلجيكا',
            'name_en' => 'Belgium',
            'phone_code' => 32,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BZ',
            'name_ar' => 'بيليز',
            'name_en' => 'Belize',
            'phone_code' => 501,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BJ',
            'name_ar' => 'بنين',
            'name_en' => 'Benin',
            'phone_code' => 229,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BM',
            'name_ar' => 'Bermuda',
            'name_en' => 'Bermuda',
            'phone_code' => 1441,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BT',
            'name_ar' => 'بوتان',
            'name_en' => 'Bhutan',
            'phone_code' => 975,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BO',
            'name_ar' => 'بوليفيا',
            'name_en' => 'Bolivia',
            'phone_code' => 591,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BA',
            'name_ar' => 'البوسنة والهرسك',
            'name_en' => 'Bosnia and Herzegovina',
            'phone_code' => 387,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BW',
            'name_ar' => 'بوتسوانا',
            'name_en' => 'Botswana',
            'phone_code' => 267,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BV',
            'name_ar' => 'Bouvet Island',
            'name_en' => 'Bouvet Island',
            'phone_code' => 0,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BR',
            'name_ar' => 'البرازيل',
            'name_en' => 'Brazil',
            'phone_code' => 55,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'IO',
            'name_ar' => 'British Indian Ocean Territory',
            'name_en' => 'British Indian Ocean Territory',
            'phone_code' => 246,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BN',
            'name_ar' => 'بروناى',
            'name_en' => 'Brunei',
            'phone_code' => 673,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BG',
            'name_ar' => 'بلغاريا',
            'name_en' => 'Bulgaria',
            'phone_code' => 359,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BF',
            'name_ar' => 'بوركينا فاسو',
            'name_en' => 'Burkina Faso',
            'phone_code' => 226,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'BI',
            'name_ar' => 'بوروندى',
            'name_en' => 'Burundi',
            'phone_code' => 257,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KH',
            'name_ar' => 'كمبوديا',
            'name_en' => 'Cambodia',
            'phone_code' => 855,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CM',
            'name_ar' => 'الكاميرون',
            'name_en' => 'Cameroon',
            'phone_code' => 237,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CA',
            'name_ar' => 'كندا',
            'name_en' => 'Canada',
            'phone_code' => 1,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CV',
            'name_ar' => 'الرأس الاخضر',
            'name_en' => 'Cape Verde',
            'phone_code' => 238,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KY',
            'name_ar' => 'Cayman Islands',
            'name_en' => 'Cayman Islands',
            'phone_code' => 1345,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CF',
            'name_ar' => 'جمهورية افريقيا الوسطى',
            'name_en' => 'Central African Republic',
            'phone_code' => 236,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TD',
            'name_ar' => 'تشاد',
            'name_en' => 'Chad',
            'phone_code' => 235,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CL',
            'name_ar' => 'شيلى',
            'name_en' => 'Chile',
            'phone_code' => 56,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CN',
            'name_ar' => 'الصين',
            'name_en' => 'China',
            'phone_code' => 86,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CX',
            'name_ar' => 'Christmas Island',
            'name_en' => 'Christmas Island',
            'phone_code' => 61,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CC',
            'name_ar' => 'Cocos (Keeling) Islands',
            'name_en' => 'Cocos (Keeling) Islands',
            'phone_code' => 672,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CO',
            'name_ar' => 'كولمبيا',
            'name_en' => 'Colombia',
            'phone_code' => 57,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KM',
            'name_ar' => 'جزر الُقمـــر',
            'name_en' => 'Comoros',
            'phone_code' => 269,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CG',
            'name_ar' => 'جمهورية الكونغو',
            'name_en' => 'Republic Of The Congo',
            'phone_code' => 242,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CD',
            'name_ar' => 'جمهورية الكونغو الديمقراطية',
            'name_en' => 'Democratic Republic Of The Congo',
            'phone_code' => 242,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CK',
            'name_ar' => 'Cook Islands',
            'name_en' => 'Cook Islands',
            'phone_code' => 682,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CR',
            'name_ar' => 'كوستاريكا',
            'name_en' => 'Costa Rica',
            'phone_code' => 506,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CI',
            'name_ar' => 'كوت ديفوار',
            'name_en' => 'Cote D Ivoire (Ivory Coast)',
            'phone_code' => 225,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'HR',
            'name_ar' => 'كرواتيا',
            'name_en' => 'Croatia (Hrvatska)',
            'phone_code' => 385,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CU',
            'name_ar' => 'كوبا',
            'name_en' => 'Cuba',
            'phone_code' => 53,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CY',
            'name_ar' => 'قبرص',
            'name_en' => 'Cyprus',
            'phone_code' => 357,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CZ',
            'name_ar' => 'جمهورية التشيك',
            'name_en' => 'Czech Republic',
            'phone_code' => 420,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'DK',
            'name_ar' => 'الدنمارك',
            'name_en' => 'Denmark',
            'phone_code' => 45,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'DJ',
            'name_ar' => 'جيبوتى',
            'name_en' => 'Djibouti',
            'phone_code' => 253,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'DM',
            'name_ar' => 'دومينيكا',
            'name_en' => 'Dominica',
            'phone_code' => 1767,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'DO',
            'name_ar' => 'الدومينيكان',
            'name_en' => 'Dominican Republic',
            'phone_code' => 1809,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TP',
            'name_ar' => 'تيمور الشرقية',
            'name_en' => 'East Timor',
            'phone_code' => 670,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'EC',
            'name_ar' => 'الاكوادور',
            'name_en' => 'Ecuador',
            'phone_code' => 593,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        $egyptCountry = Country::create([
            'code' => 'EG',
            'name_ar' => 'مصر',
            'name_en' => 'Egypt',
            'phone_code' => 20,
        ]);

        // Start Add cities to Egypt
        Governorate::create([
            'name_ar' => 'الإسكندرية',
            'name_en' => 'Alexandria',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'الإسماعيلية',
            'name_en' => 'Ismailia',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'أسوان',
            'name_en' => 'Aswan',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'أسيوط',
            'name_en' => 'Asyut',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'الأقصر',
            'name_en' => 'Luxor',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'البحر الأحمر',
            'name_en' => 'Red Sea',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'البحيرة',
            'name_en' => 'Beheira',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'بني سويف',
            'name_en' => 'Beni Suef',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'بورسعيد',
            'name_en' => 'Port Said',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'جنوب سيناء',
            'name_en' => 'South Sinai',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'الجيزة',
            'name_en' => 'Giza',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'الدقهلية',
            'name_en' => 'Dakahlia',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'دمياط',
            'name_en' => 'Damietta',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'سوهاج',
            'name_en' => 'Sohag',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'السويس',
            'name_en' => 'Suez',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'الشرقية',
            'name_en' => 'Sharqia',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'شمال سيناء',
            'name_en' => 'North Sinai',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'الغربية',
            'name_en' => 'Gharbia',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'الفيوم',
            'name_en' => 'Fayoum',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'القاهرة',
            'name_en' => 'Cairo',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'القليوبية',
            'name_en' => 'Qalyubia',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'قنا',
            'name_en' => 'Qena',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'كفر الشيخ',
            'name_en' => 'Kafr el-Sheikh',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'مطروح',
            'name_en' => 'Matruh',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'المنوفية',
            'name_en' => 'Monufia',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'المنيا',
            'name_en' => 'Minya',
            'country_id' => $egyptCountry->id,
        ]);
        Governorate::create([
            'name_ar' => 'الوادي الجديد',
            'name_en' => 'New Valley',
            'country_id' => $egyptCountry->id,
        ]);
        // End Add governorates to Egypt

        Country::create([
            'code' => 'SV',
            'name_ar' => 'السلفادور',
            'name_en' => 'El Salvador',
            'phone_code' => 503,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GQ',
            'name_ar' => 'غينيا الاستوائية',
            'name_en' => 'Equatorial Guinea',
            'phone_code' => 240,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'ER',
            'name_ar' => 'اريتريا',
            'name_en' => 'Eritrea',
            'phone_code' => 291,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'EE',
            'name_ar' => 'استونيا',
            'name_en' => 'Estonia',
            'phone_code' => 372,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'ET',
            'name_ar' => 'اثيوبيا',
            'name_en' => 'Ethiopia',
            'phone_code' => 251,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'XA',
            'name_ar' => 'External Territories of Australia',
            'name_en' => 'External Territories of Australia',
            'phone_code' => 61,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'FK',
            'name_ar' => 'Falkland Islands',
            'name_en' => 'Falkland Islands',
            'phone_code' => 500,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'FO',
            'name_ar' => 'Faroe Islands',
            'name_en' => 'Faroe Islands',
            'phone_code' => 298,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'FJ',
            'name_ar' => 'جزر فيجى',
            'name_en' => 'Fiji Islands',
            'phone_code' => 679,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'FI',
            'name_ar' => 'فنلندا',
            'name_en' => 'Finland',
            'phone_code' => 358,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'FR',
            'name_ar' => 'فرنسا',
            'name_en' => 'France',
            'phone_code' => 33,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GF',
            'name_ar' => 'French Guiana',
            'name_en' => 'French Guiana',
            'phone_code' => 594,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PF',
            'name_ar' => 'French Polynesia',
            'name_en' => 'French Polynesia',
            'phone_code' => 689,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TF',
            'name_ar' => 'French Southern Territories',
            'name_en' => 'French Southern Territories',
            'phone_code' => 0,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GA',
            'name_ar' => 'الجابون',
            'name_en' => 'Gabon',
            'phone_code' => 241,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GM',
            'name_ar' => 'جامبيا',
            'name_en' => 'The Gambia',
            'phone_code' => 220,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GE',
            'name_ar' => 'جورجيا',
            'name_en' => 'Georgia',
            'phone_code' => 995,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'DE',
            'name_ar' => 'المانيا',
            'name_en' => 'Germany',
            'phone_code' => 49,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GH',
            'name_ar' => 'غانا',
            'name_en' => 'Ghana',
            'phone_code' => 233,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GI',
            'name_ar' => 'Gibraltar',
            'name_en' => 'Gibraltar',
            'phone_code' => 350,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GR',
            'name_ar' => 'اليونان',
            'name_en' => 'Greece',
            'phone_code' => 30,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GL',
            'name_ar' => 'Greenland',
            'name_en' => 'Greenland',
            'phone_code' => 299,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GD',
            'name_ar' => 'جرانادا',
            'name_en' => 'Grenada',
            'phone_code' => 1473,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GP',
            'name_ar' => 'Guadeloupe',
            'name_en' => 'Guadeloupe',
            'phone_code' => 590,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GU',
            'name_ar' => 'Guam',
            'name_en' => 'Guam',
            'phone_code' => 1671,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GT',
            'name_ar' => 'جواتيمالا',
            'name_en' => 'Guatemala',
            'phone_code' => 502,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'XU',
            'name_ar' => 'Guernsey and Alderney',
            'name_en' => 'Guernsey and Alderney',
            'phone_code' => 44,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GN',
            'name_ar' => 'غينيا',
            'name_en' => 'Guinea',
            'phone_code' => 224,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GW',
            'name_ar' => 'غينيا بيساو',
            'name_en' => 'Guinea-Bissau',
            'phone_code' => 245,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GY',
            'name_ar' => 'جويانا	',
            'name_en' => 'Guyana',
            'phone_code' => 592,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'HT',
            'name_ar' => 'هايتى',
            'name_en' => 'Haiti',
            'phone_code' => 509,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'HM',
            'name_ar' => 'Heard and McDonald Islands',
            'name_en' => 'Heard and McDonald Islands',
            'phone_code' => 0,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'HN',
            'name_ar' => 'هندوراس',
            'name_en' => 'Honduras',
            'phone_code' => 504,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'HK',
            'name_ar' => 'Hong Kong S.A.R.',
            'name_en' => 'Hong Kong S.A.R.',
            'phone_code' => 852,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'HU',
            'name_ar' => 'المجر',
            'name_en' => 'Hungary',
            'phone_code' => 36,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'IS',
            'name_ar' => 'ايسلندا',
            'name_en' => 'Iceland',
            'phone_code' => 354,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'IN',
            'name_ar' => 'الهند',
            'name_en' => 'India',
            'phone_code' => 91,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => '',
            'name_ar' => 'اندونيسيا',
            'name_en' => 'Indonesia',
            'phone_code' => 62,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'IR',
            'name_ar' => 'ايران',
            'name_en' => 'Iran',
            'phone_code' => 98,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'IQ',
            'name_ar' => 'العراق',
            'name_en' => 'Iraq',
            'phone_code' => 964,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'IE',
            'name_ar' => 'ايرلندا',
            'name_en' => 'Ireland',
            'phone_code' => 353,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'IT',
            'name_ar' => 'ايطاليا',
            'name_en' => 'Italy',
            'phone_code' => 39,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'JM',
            'name_ar' => 'جاميكا',
            'name_en' => 'Jamaica',
            'phone_code' => 1876,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'JP',
            'name_ar' => 'اليابان',
            'name_en' => 'Japan',
            'phone_code' => 81,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'XJ',
            'name_ar' => 'Jersey',
            'name_en' => 'Jersey',
            'phone_code' => 44,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'JO',
            'name_ar' => 'الاردن',
            'name_en' => 'Jordan',
            'phone_code' => 962,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KZ',
            'name_ar' => 'كازاخستان',
            'name_en' => 'Kazakhstan',
            'phone_code' => 7,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KE',
            'name_ar' => 'كينيا',
            'name_en' => 'Kenya',
            'phone_code' => 254,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KI',
            'name_ar' => 'كيريباتى',
            'name_en' => 'Kiribati',
            'phone_code' => 686,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KP',
            'name_ar' => 'كوريا الشمالية',
            'name_en' => 'Korea North',
            'phone_code' => 850,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KR',
            'name_ar' => 'كوريا الجنوبية',
            'name_en' => 'Korea South',
            'phone_code' => 82,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KW',
            'name_ar' => 'الكويت',
            'name_en' => 'Kuwait',
            'phone_code' => 965,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KG',
            'name_ar' => 'قرغيزستان',
            'name_en' => 'Kyrgyzstan',
            'phone_code' => 996,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LA',
            'name_ar' => 'لاوس',
            'name_en' => 'Laos',
            'phone_code' => 856,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LV',
            'name_ar' => 'لاتفيا',
            'name_en' => 'Latvia',
            'phone_code' => 371,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LB',
            'name_ar' => 'لُبنان',
            'name_en' => 'Lebanon',
            'phone_code' => 961,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LS',
            'name_ar' => 'ليسوتو',
            'name_en' => 'Lesotho',
            'phone_code' => 266,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LR',
            'name_ar' => 'ليبيريا',
            'name_en' => 'Liberia',
            'phone_code' => 231,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LY',
            'name_ar' => 'ليبيا',
            'name_en' => 'Libya',
            'phone_code' => 218,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LI',
            'name_ar' => 'ليختنشتاين',
            'name_en' => 'Liechtenstein',
            'phone_code' => 423,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LT',
            'name_ar' => 'ليتوانيا',
            'name_en' => 'Lithuania',
            'phone_code' => 370,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LU',
            'name_ar' => 'لوكسمبورج',
            'name_en' => 'Luxembourg',
            'phone_code' => 352,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MO',
            'name_ar' => 'Macau S.A.R.',
            'name_en' => 'Macau S.A.R.',
            'phone_code' => 853,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MK',
            'name_ar' => 'مقدونيا',
            'name_en' => 'Macedonia',
            'phone_code' => 389,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MG',
            'name_ar' => 'مدغشقر',
            'name_en' => 'Madagascar',
            'phone_code' => 261,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MW',
            'name_ar' => 'مالاوى',
            'name_en' => 'Malawi',
            'phone_code' => 265,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MY',
            'name_ar' => 'ماليزيا',
            'name_en' => 'Malaysia',
            'phone_code' => 60,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MV',
            'name_ar' => 'جزر المالديف',
            'name_en' => 'Maldives',
            'phone_code' => 960,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'ML',
            'name_ar' => 'مالى',
            'name_en' => 'Mali',
            'phone_code' => 223,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MT',
            'name_ar' => 'جزيرة مالطا',
            'name_en' => 'Malta',
            'phone_code' => 356,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'XM',
            'name_ar' => 'Man (Isle of)',
            'name_en' => 'Man (Isle of)',
            'phone_code' => 44,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MH',
            'name_ar' => 'جزر مارشال',
            'name_en' => 'Marshall Islands',
            'phone_code' => 692,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MQ',
            'name_ar' => 'Martinique',
            'name_en' => 'Martinique',
            'phone_code' => 596,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MR',
            'name_ar' => 'موريتانيا',
            'name_en' => 'Mauritania',
            'phone_code' => 222,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MU',
            'name_ar' => 'موريشيوس',
            'name_en' => 'Mauritius',
            'phone_code' => 230,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'YT',
            'name_ar' => 'Mayotte',
            'name_en' => 'Mayotte',
            'phone_code' => 269,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MX',
            'name_ar' => 'المكسيك',
            'name_en' => 'Mexico',
            'phone_code' => 52,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'FM',
            'name_ar' => 'جزر مايكرونيزيا',
            'name_en' => 'Micronesia',
            'phone_code' => 691,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MD',
            'name_ar' => 'مولدوفيا',
            'name_en' => 'Moldova',
            'phone_code' => 373,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MC',
            'name_ar' => 'امارة موناكو',
            'name_en' => 'Monaco',
            'phone_code' => 377,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MN',
            'name_ar' => 'منغوليا',
            'name_en' => 'Mongolia',
            'phone_code' => 976,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MS',
            'name_ar' => 'Montserrat',
            'name_en' => 'Montserrat',
            'phone_code' => 1664,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MA',
            'name_ar' => 'المغرب',
            'name_en' => 'Morocco',
            'phone_code' => 212,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MZ',
            'name_ar' => 'موزمبيق',
            'name_en' => 'Mozambique',
            'phone_code' => 258,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MM',
            'name_ar' => 'ميانمار (بورما)',
            'name_en' => 'Myanmar (Burma)',
            'phone_code' => 95,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NA',
            'name_ar' => 'ناميبيا',
            'name_en' => 'Namibia',
            'phone_code' => 264,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NR',
            'name_ar' => 'ناورو',
            'name_en' => 'Nauru',
            'phone_code' => 674,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NP',
            'name_ar' => 'نيبال',
            'name_en' => 'Nepal',
            'phone_code' => 977,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AN',
            'name_ar' => 'Netherlands Antilles',
            'name_en' => 'Netherlands Antilles',
            'phone_code' => 599,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NL',
            'name_ar' => 'هولندا',
            'name_en' => 'Netherlands',
            'phone_code' => 31,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NC',
            'name_ar' => 'New Caledonia',
            'name_en' => 'New Caledonia',
            'phone_code' => 687,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NZ',
            'name_ar' => 'نيوزيلندا',
            'name_en' => 'New Zealand',
            'phone_code' => 64,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NI',
            'name_ar' => 'نيكاراجوا',
            'name_en' => 'Nicaragua',
            'phone_code' => 505,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NE',
            'name_ar' => 'النيجر',
            'name_en' => 'Niger',
            'phone_code' => 227,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NG',
            'name_ar' => 'نيجيريا',
            'name_en' => 'Nigeria',
            'phone_code' => 234,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NU',
            'name_ar' => 'Niue',
            'name_en' => 'Niue',
            'phone_code' => 683,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NF',
            'name_ar' => 'Norfolk Island',
            'name_en' => 'Norfolk Island',
            'phone_code' => 672,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'MP',
            'name_ar' => 'Northern Mariana Islands',
            'name_en' => 'Northern Mariana Islands',
            'phone_code' => 1670,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'NO',
            'name_ar' => 'النرويج',
            'name_en' => 'Norway',
            'phone_code' => 47,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'OM',
            'name_ar' => 'سَلْطَنَة عُمان',
            'name_en' => 'Oman',
            'phone_code' => 968,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PK',
            'name_ar' => 'باكستان',
            'name_en' => 'Pakistan',
            'phone_code' => 92,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PW',
            'name_ar' => 'بالو',
            'name_en' => 'Palau',
            'phone_code' => 680,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PS',
            'name_ar' => 'فلسطين (الأراضي الفلسطينية المحتلة)',
            'name_en' => 'Palestine (Palestinian Territory Occupied)',
            'phone_code' => 970,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PA',
            'name_ar' => 'بنما',
            'name_en' => 'Panama',
            'phone_code' => 507,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PG',
            'name_ar' => 'بابوا غينيا الجديدة',
            'name_en' => 'Papua new Guinea',
            'phone_code' => 675,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PY',
            'name_ar' => 'باراجوى',
            'name_en' => 'Paraguay',
            'phone_code' => 595,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PE',
            'name_ar' => 'بيرو',
            'name_en' => 'Peru',
            'phone_code' => 51,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PH',
            'name_ar' => 'الفلبين',
            'name_en' => 'Philippines',
            'phone_code' => 63,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PN',
            'name_ar' => 'Pitcairn Island',
            'name_en' => 'Pitcairn Island',
            'phone_code' => 0,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PL',
            'name_ar' => 'بولندا',
            'name_en' => 'Poland',
            'phone_code' => 48,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PT',
            'name_ar' => 'البرتغال',
            'name_en' => 'Portugal',
            'phone_code' => 351,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PR',
            'name_ar' => 'Puerto Rico',
            'name_en' => 'Puerto Rico',
            'phone_code' => 1787,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'QA',
            'name_ar' => 'قطر',
            'name_en' => 'Qatar',
            'phone_code' => 974,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'RE',
            'name_ar' => 'Reunion',
            'name_en' => 'Reunion',
            'phone_code' => 262,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'RO',
            'name_ar' => 'رومانيا',
            'name_en' => 'Romania',
            'phone_code' => 40,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'RU',
            'name_ar' => 'روسيا الاتحادية',
            'name_en' => 'Russia',
            'phone_code' => 70,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'RW',
            'name_ar' => 'رواندا',
            'name_en' => 'Rwanda',
            'phone_code' => 250,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SH',
            'name_ar' => 'Saint Helena',
            'name_en' => 'Saint Helena',
            'phone_code' => 290,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'KN',
            'name_ar' => 'سان كيتس اند نيفز',
            'name_en' => 'Saint Kitts And Nevis',
            'phone_code' => 1869,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LC',
            'name_ar' => 'سان لوتشيا',
            'name_en' => 'Saint Lucia',
            'phone_code' => 1758,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'PM',
            'name_ar' => 'Saint Pierre and Miquelon',
            'name_en' => 'Saint Pierre and Miquelon',
            'phone_code' => 508,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'VC',
            'name_ar' => 'سان فنسن وجرينادينز',
            'name_en' => 'Saint Vincent And The Grenadines',
            'phone_code' => 1784,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'WS',
            'name_ar' => 'ساموا',
            'name_en' => 'Samoa',
            'phone_code' => 684,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SM',
            'name_ar' => 'سان مارينو',
            'name_en' => 'San Marino',
            'phone_code' => 378,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'ST',
            'name_ar' => 'ساوتومى اند برنسيب',
            'name_en' => 'Sao Tome and Principe',
            'phone_code' => 239,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SA',
            'name_ar' => 'السعودية',
            'name_en' => 'Saudi Arabia',
            'phone_code' => 966,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SN',
            'name_ar' => 'السنغال',
            'name_en' => 'Senegal',
            'phone_code' => 221,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'RS',
            'name_ar' => 'صربيا',
            'name_en' => 'Serbia',
            'phone_code' => 381,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SC',
            'name_ar' => 'جزر سيشل',
            'name_en' => 'Seychelles',
            'phone_code' => 248,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SL',
            'name_ar' => 'سيراليون',
            'name_en' => 'Sierra Leone',
            'phone_code' => 232,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SG',
            'name_ar' => 'سنغافورة',
            'name_en' => 'Singapore',
            'phone_code' => 65,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SK',
            'name_ar' => 'سلوفاكيا',
            'name_en' => 'Slovakia',
            'phone_code' => 421,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SI',
            'name_ar' => 'سلوفينيا',
            'name_en' => 'Slovenia',
            'phone_code' => 386,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'XG',
            'name_ar' => 'Smaller Territories of the UK',
            'name_en' => 'Smaller Territories of the UK',
            'phone_code' => 44,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SB',
            'name_ar' => 'جزر سولومون',
            'name_en' => 'Solomon Islands',
            'phone_code' => 677,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SO',
            'name_ar' => 'الصومال',
            'name_en' => 'Somalia',
            'phone_code' => 252,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'ZA',
            'name_ar' => 'جنوب افريقيا',
            'name_en' => 'South Africa',
            'phone_code' => 27,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GS',
            'name_ar' => 'South Georgia',
            'name_en' => 'South Georgia',
            'phone_code' => 0,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SS',
            'name_ar' => 'South Sudan',
            'name_en' => 'South Sudan',
            'phone_code' => 211,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'ES',
            'name_ar' => 'إسبانيا',
            'name_en' => 'Spain',
            'phone_code' => 34,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'LK',
            'name_ar' => 'سريلانكا',
            'name_en' => 'Sri Lanka',
            'phone_code' => 94,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SD',
            'name_ar' => 'السودان',
            'name_en' => 'Sudan',
            'phone_code' => 249,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SR',
            'name_ar' => 'سورينام',
            'name_en' => 'Suriname',
            'phone_code' => 597,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SJ',
            'name_ar' => 'Svalbard And Jan Mayen Islands',
            'name_en' => 'Svalbard And Jan Mayen Islands',
            'phone_code' => 47,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SZ',
            'name_ar' => 'سوازيلاند',
            'name_en' => 'Swaziland',
            'phone_code' => 268,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SE',
            'name_ar' => 'السويد',
            'name_en' => 'Sweden',
            'phone_code' => 46,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'CH',
            'name_ar' => 'سويسرا',
            'name_en' => 'Switzerland',
            'phone_code' => 41,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'SY',
            'name_ar' => 'سوريا',
            'name_en' => 'Syria',
            'phone_code' => 963,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TW',
            'name_ar' => 'تايوان',
            'name_en' => 'Taiwan',
            'phone_code' => 886,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TJ',
            'name_ar' => 'طاجكستان',
            'name_en' => 'Tajikistan',
            'phone_code' => 992,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TZ',
            'name_ar' => 'تنزانيا',
            'name_en' => 'Tanzania',
            'phone_code' => 255,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TH',
            'name_ar' => 'تايلاند',
            'name_en' => 'Thailand',
            'phone_code' => 66,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TG',
            'name_ar' => 'توجو',
            'name_en' => 'Togo',
            'phone_code' => 228,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TK',
            'name_ar' => 'Tokelau',
            'name_en' => 'Tokelau',
            'phone_code' => 690,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TO',
            'name_ar' => 'تونجا',
            'name_en' => 'Tonga',
            'phone_code' => 676,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TT',
            'name_ar' => 'ترينداد وتوباغو',
            'name_en' => 'Trinad And Tobago',
            'phone_code' => 1868,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TN',
            'name_ar' => 'تونِس',
            'name_en' => 'Tunisia',
            'phone_code' => 216,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TR',
            'name_ar' => 'تركيا',
            'name_en' => 'Turkey',
            'phone_code' => 90,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TM',
            'name_ar' => 'تركمانستان',
            'name_en' => 'Turkmenistan',
            'phone_code' => 7370,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TC',
            'name_ar' => 'Turks And Caicos Islands',
            'name_en' => 'Turks And Caicos Islands',
            'phone_code' => 1649,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'TV',
            'name_ar' => 'توفالو',
            'name_en' => 'Tuvalu',
            'phone_code' => 688,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'UG',
            'name_ar' => 'اوغندا',
            'name_en' => 'Uganda',
            'phone_code' => 256,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'UA',
            'name_ar' => 'اوكرانيا',
            'name_en' => 'Ukraine',
            'phone_code' => 380,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'AE',
            'name_ar' => 'الامارات العربية المتحدة',
            'name_en' => 'United Arab Emirates',
            'phone_code' => 971,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'GB',
            'name_ar' => 'المملكة المتحدة',
            'name_en' => 'United Kingdom',
            'phone_code' => 44,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'US',
            'name_ar' => 'الولايات المتحدة الامريكية',
            'name_en' => 'United States',
            'phone_code' => 1,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'UM',
            'name_ar' => 'United States Minor Outlying Islands',
            'name_en' => 'United States Minor Outlying Islands',
            'phone_code' => 1,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'UY',
            'name_ar' => 'اورجواى',
            'name_en' => 'Uruguay',
            'phone_code' => 598,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'UZ',
            'name_ar' => 'اوزباكستان',
            'name_en' => 'Uzbekistan',
            'phone_code' => 998,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'VU',
            'name_ar' => 'فانواتو',
            'name_en' => 'Vanuatu',
            'phone_code' => 678,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'VA',
            'name_ar' => 'الفاتيكان',
            'name_en' => 'Vatican City State (Holy See)',
            'phone_code' => 39,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'VE',
            'name_ar' => 'فنزويلا',
            'name_en' => 'Venezuela',
            'phone_code' => 58,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'VN',
            'name_ar' => 'فيتنام',
            'name_en' => 'Vietnam',
            'phone_code' => 84,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'VG',
            'name_ar' => 'Virgin Islands (British)',
            'name_en' => 'Virgin Islands (British)',
            'phone_code' => 1284,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'VI',
            'name_ar' => 'Virgin Islands (US)',
            'name_en' => 'Virgin Islands (US)',
            'phone_code' => 1340,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'WF',
            'name_ar' => 'Wallis And Futuna Islands',
            'name_en' => 'Wallis And Futuna Islands',
            'phone_code' => 681,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'EH',
            'name_ar' => 'Western Sahara',
            'name_en' => 'Western Sahara',
            'phone_code' => 212,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'YE',
            'name_ar' => 'اليمن',
            'name_en' => 'Yemen',
            'phone_code' => 967,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'YU',
            'name_ar' => 'Yugoslavia',
            'name_en' => 'Yugoslavia',
            'phone_code' => 38,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'ZM',
            'name_ar' => 'زامبيا',
            'name_en' => 'Zambia',
            'phone_code' => 260,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
        Country::create([
            'code' => 'ZW',
            'name_ar' => 'زيمبابوى',
            'name_en' => 'Zimbabwe',
            'phone_code' => 26,
            'deleted_at' => '2021-08-10 10:00:11',
        ]);
    }
}
