<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        // $this->call(SectorSeeder::class);
        // $this->call(DepartmentSeeder::class);
        $this->call(Country_GovernorateSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(SubGroupSeeder::class);
        $this->call(FamilyNameSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(SectorDepartmentSeeder::class);
        $this->call(JobCodeSeeder::class);
        $this->call(JobNameSeeder::class);
        $this->call(JobGradeSeeder::class);
        // $this->call(ProjectSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(ApprovalCycleSeeder::class);
        $this->call(ApprovalStepSeeder::class);
        $this->call(ApprovalCycleApprovalStepSeeder::class);
        // $this->call(ApprovalTimelineSeeder::class);
        // $this->call(PurchaseRequestSeeder::class);
    }
}
