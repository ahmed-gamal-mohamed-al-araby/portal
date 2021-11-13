<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            "country_id" => 64,
            "governorate_id" => 1,
            "city_ar" => "مصر الجديدة",
            "city_en" => "new egypt",
            "street_ar" => "وزارة الدفاع",
            "street_en" => "ministry of defense",
            "building_no" => "0",
        ]);

        Address::create([
            "country_id" => 64,
            "governorate_id" => 1,
            "city_ar" => "شيراتون",
            "city_en" => "Sheraton",
            "street_ar" => "مربع 1157 مكرر مساكن شيراتون",
            "street_en" => "Square 1157 bis Sheraton Residences",
            "building_no" => "8",
        ]);

        Address::create([
            "country_id" => 64,
            "governorate_id" => 1,
            "city_ar" => "شيراتون",
            "city_en" => "Sheraton",
            "street_ar" => "مربع 1111 مكرر مساكن شيراتون",
            "street_en" => "Square 1111 bis Sheraton Residences",
            "building_no" => "58",
        ]);
    }
}
