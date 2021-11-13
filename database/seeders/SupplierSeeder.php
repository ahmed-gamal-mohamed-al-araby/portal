<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\FamilyNameSupplier;
use App\Models\PersonSupplier;
use App\Models\Supplier;
use App\Models\SupplierBankTransfer;
use App\Models\SupplierCheque;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        for ($i = 0; $i < 10; $i++) {
            $address = Address::create([
                "country_id" => 1,
                "governorate_id" => $i + 1,
                "city_ar" => 'العبور',
                "city_en" => 'Al-obbour',
                "street_ar" => 'الشهداء',
                "street_en" => 'Shohadaa',
                "building_no" => $i + 1,
            ]);

            $supplier = Supplier::create([
                "name_ar" => "مورد" . ($i + 1),
                "name_en" => "Supplier" . ($i + 1),
                "fax" => "Supplier" . ($i) . ' Fax',
                "address_id" => ($i % 3) + 1,
                "phone" => "123456",
                "mobile" => "011123456",
                "email" => "Supplier" . ($i + 1) . '@gmail.com',
                "website_url" => "https://Supplier" . ($i) . ".com",
                "gmap_url" => "https://Supplier" . ($i) . "-gmap.com",
                "person_note" => "Supplier" . ($i) . ' person_note',
                "family_name_note" => "Supplier" . ($i) . ' family_name_note',
                "accredite_note" => "Supplier" . ($i) . ' accredite_note',
                "tax_id_number" => "000-000-000",
                "commercial_registeration_number" => "12345",
                "cash" => 1,
                "deleted_at" => ($i % 2) ? '2021-08-02 14:31:10' : null,
            ]);

            SupplierCheque::create([
                'name_on_cheque' => 'name_on_cheque Supplier' . ($i + 1),
                'supplier_id' => $supplier->id,
            ]);

            SupplierBankTransfer::create([
                'bank_account_number' => '123456' . $i,
                'bank_name' => 'Bank' . $i,
                'bank_branch' => 'bank_branch' . $i . $i,
                'supplier_id' => $supplier->id,
            ]);

            for ($j = 0; $j < 2; $j++) {
                PersonSupplier::create([
                    'name' => 'Ahmed' . $i . ($j + 1),
                    'job' => 'Job' . $i . ($j + 1),
                    'mobile' =>  '11111111',
                    'whatsapp' => '11111111',
                    'email' => 'ahmed' . $i . $j . '@gmail.com',
                    'supplier_id' => $supplier->id,
                ]);
            }

            for ($j = 0; $j < 3; $j++) {
                FamilyNameSupplier::create([
                    'supplier_id' => $supplier->id,
                    'family_name_id' => ($j + 2),
                ]);
                FamilyNameSupplier::create([
                    'supplier_id' => $supplier->id,
                    'family_name_id' => ($j + 6),
                ]);
            }
        }
    }
}
