<?php

namespace Database\Seeders;

use App\Models\ApprovalStep;
use Illuminate\Database\Seeder;

class ApprovalStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* depth
            // relation via models
        */

         /* query
            // T: satnds for Table name
            // CONs: stands for conditions
            // CN: stands for Column name
            // CV: stands for Column value
        */

        ApprovalStep::create([
            'name_ar' => 'المدير المباشر',
            'name_en' => 'Direct manager',
            'code' => 'DIR_M',
            'value' => '{"depth":["manager"], "query" : []}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'مدير القسم',
            'name_en' => 'Department manager',
            'code' => 'DEP_M',
            'value' => '{"depth":["department", "manager"], "query" : []}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'رئيس القطاع',
            'name_en' => 'Sector head',
            'code' => 'SEC_H',
            'value' => '{"depth":["sector", "head"], "query" : []}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'الرئيس التنفيذي',
            'name_en' => 'Chief Executive Officer (CEO)',
            'code' => 'CEO_H',
            'value' => '{"depth":[],"query":{"T":"sectors","CONs":[{"CN":"name_en","CV":"Chief Executive Officer (CEO)"}],"depth":["first()" ,"head"]}}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'الرئيس التنفيذي للعمليات',
            'name_en' => 'Chief Operating Officer (COO)',
            'code' => 'COO_H',
            'value' => '{"depth":[],"query":{"T":"sectors","CONs":[{"CN":"name_en","CV":"Chief Operating Officer (COO)"}],"depth":["first()" ,"head"]}}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'المدير المالي',
            'name_en' => 'Chief Financial Officer (CFO)',
            'code' => 'CFO_H',
            'value' => '{"depth":[],"query":{"T":"sectors","CONs":[{"CN":"name_en","CV":"Chief Financial Officer (CFO)}],"depth":["first()" ,"head"]}}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'رئيس قطاع التخطيط',
            'name_en' => 'Planning sector head',
            'code' => 'Pln_H',
            'value' => '{"depth":[],"query":{"T":"sectors","CONs":[{"CN":"name_en","CV":"Corporate Planning & Development"}],"depth":["first()" ,"head"]}}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'رئيس قطاع المشتريات',
            'name_en' => 'Purchasing sector head',
            'code' => 'PUR_H',
            'value' => '{"depth":[],"query":{"T":"sectors","CONs":[{"CN":"name_en","CV":"Purchasing"}],"depth":["first()" ,"head"]}}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'مدير المشروع',
            'name_en' => 'Project manager',
            'code' => 'PRO_M',
            'value' => '{"depth":["project", "manager"], "query" : []}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'رئيس المكتب الفني للبناء - المدني',
            'name_en' => 'Civil Technical Office',
            'code' => 'TEC_OFF_Civil',
            'value' => '{"depth":[],"query":{"T":"departments","CONs":[{"CN":"name_en","CV":"Civil Technical Office"}],"depth":["first()" ,"manager"]}}',
        ]);

        ApprovalStep::create([
            'name_ar' => 'رئيس المكتب الفني للهندسة الكهربائية والميكانيكية',
            'name_en' => 'MEP Technical Office',
            'code' => 'TEC_OFF_MEP',
            'value' => '{"depth":[],"query":{"T":"departments","CONs":[{"CN":"name_en","CV":"MEP Technical Office"}],"depth":["first()" ,"manager"]}}',
        ]);
    }
}
