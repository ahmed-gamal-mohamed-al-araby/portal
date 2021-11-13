<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Project;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Database\Seeder;

class SectorDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // -------------------------------- START CEO Sector --------------------------------
        // Waheed Adly Iskandar (1)
        $CEOHead = User::create([
            'username' => 'waheed.adly',
            'name_ar' => 'وحيد عدلى اسكندر',
            'name_en' => 'Waheed Adly Iskandar',
            'email' => 'Chief.Executive.Officer.fake@eecegypt.com',
            'code' => '1',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيس مجلس الادارة العضو المنتدب',
            'position_en' => 'Chairman & CEO',
            'board_member' => 1,
        ]);
        /*
        $CEOSector = Sector::create([
            'name_ar' => 'الرئيس التنفيذى',
            'name_en' => 'Chief Executive Officer (CEO)',
            'head_id' => $CEOHead->id,
            'parent_id' => null,
            'delegated_id' => 1,
        ]);
        $CEOHead->update([
            'sector_id'  => $CEOSector->id,
        ]);
        */
        // CEO sector Departments
        // CEO sector Employees
        // -------------------------------- END CEO Sector --------------------------------



        // -------------------------------- START COO Sector --------------------------------
        // Sameeh Waheed Adly Iskandar (2)
        $COOHead = User::create([
            'username' => 'sameeh.waheed',
            'name_ar' => 'سميح وحيد عدلى ',
            'name_en' => 'Sameeh Waheed Adly Iskandar',
            'email' => 'Chief.Operating.Officer.fake@eecegypt.com',
            'code' => '2',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيس مجلس الادارة العضو المنتدب',
            'position_en' => 'Chairman & COO',
            'board_member' => 1,
        ]);
        $CEOSector = Sector::create([
            'name_ar' => '  الرئيس التنفيذى ',
            'name_en' => 'Chief Executive Officer (CEO)',
            'head_id' => $COOHead->id,
            'parent_id' => null,
            'delegated_id' => 1,
        ]);
        $COOHead->update([
            'sector_id'  => $CEOSector->id,
        ]);
        // COO sector Departments
        // COO sector Employees
        // -------------------------------- END COO Sector --------------------------------


        // -------------------------------- START Chief Financial Officer Sector --------------------------------
        // Amira Anwar Awadallah (23)
        $accountsAuditAndInventoryHead = User::create([
            'username' => 'amira.anwar',
            'name_ar' => 'اميرة انور عوض الله',
            'name_en' => 'Amira Anwar Awadallah',
            'email' => 'amira.anwar.awadallah.fake@eecegypt.com',
            'code' => '23',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيس قطاع الحسابات والمراجعة والمخازن',
            'position_en' => 'Head of Accounts, Audit & Inventory',
            'board_member' => 1,
        ]);

        $CFOSector = Sector::create([
            'name_ar' => 'المدير المالي',
            'name_en' => 'Chief Financial Officer (CFO)',
            'head_id' => $accountsAuditAndInventoryHead->id,
            'delegated_id' => 1
        ]);
        // -------------------------------- END Chief Financial Officer Sector --------------------------------


        // -------------------------------- START Corporate Planning & Development Sector --------------------------------
        // Fady Samir Morcos Youssef (3)
        $CorporatePlanningAndDevelopmentHead = User::create([
            'username' => 'fady.samir',
            'name_ar' => 'فادى سمير مرقص يوسف',
            'name_en' => 'Fady Samir Morcos Youssef',
            'email' => 'corporate.planning.development.fake@eecegypt.com',
            'code' => '3',
            'password' => bcrypt('123456'),
            'position_ar' => 'نائبا لرئيس مجلس الادارة للتطوير والمشروعات الجديدة',
            'position_en' => 'Vice President, Corporate Planning & Development',
            'board_member' => 1,
        ]);
        $corporatePlanningDevelopmentSector = Sector::create([
            'name_ar' => 'التخطيط والتطوير المؤسسي',
            'name_en' => 'Corporate Planning & Development',
            'head_id' => $CorporatePlanningAndDevelopmentHead->id,
            'delegated_id' => 1
        ]);
        $CorporatePlanningAndDevelopmentHead->update([
            'sector_id'  => $corporatePlanningDevelopmentSector->id,
        ]);
        // Corporate Planning & Development sector Departments
        // IT
        $ITManager = User::create([
            'username' => 'ahmed.samir',
            'name_ar' => 'احمد سمير بيومى',
            'name_en' => 'Ahmed Samir Bayoumi',
            'email' => 'ahmed.samir.fake@eecegypt.com',
            'code' => '372',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير تكنولوجيا المعلومات',
            'position_en' => 'Information Technology Manager',
            'manager_id' => $CorporatePlanningAndDevelopmentHead->id,
            'sector_id' => $corporatePlanningDevelopmentSector->id,
        ]);
        $ITDepartment = Department::create([
            'name_ar' => 'تكنولوجيا المعلومات',
            'name_en' => 'Information Technology (IT)',
            'sector_id' => $corporatePlanningDevelopmentSector->id,
            'manager_id' => $ITManager->id,
            'delegated_id' => 1,
        ]);
        $ITManager->update([
            'sector_id'  => $corporatePlanningDevelopmentSector->id,
            'department_id' => $ITDepartment->id,
            'manager_id' => $ITManager->id
        ]);

        User::where('username', 'web.team')->update([
            'sector_id' => Sector::where('name_en', 'Corporate Planning & Development')->first()->id,
            'department_id' => Department::where('name_en', 'Information Technology (IT)')->first()->id,
            'manager_id' => $ITManager->id
        ]);
        // HR
        $HRManager = User::create([
            'username' => 'christina.toplian',
            'name_ar' => 'كريستينا توبليان جرس',
            'name_en' => 'Christina Toplian Bell',
            'email' => 'christina.toplian.fake@eecegypt.com',
            'code' => '1315',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير الموارد البشرية',
            'position_en' => 'Human resources Manager',
            'manager_id' => $CorporatePlanningAndDevelopmentHead->id,
            'sector_id' => $corporatePlanningDevelopmentSector->id,
        ]);
        $HRDepartment = Department::create([
            'name_ar' => 'الموارد البشرية',
            'name_en' => 'Human resources (HR)',
            'sector_id' => $corporatePlanningDevelopmentSector->id,
            'manager_id' => $HRManager->id,
            'delegated_id' => 1,
        ]);
        $HRManager->update([
            'sector_id'  => $corporatePlanningDevelopmentSector->id,
            'department_id' => $HRDepartment->id
        ]);

        // Personnel 
        $personnelManager = User::create([
            'username' => 'mona.fouad',
            'name_ar' => 'منى فؤاد صادق',
            'name_en' => 'Mona Fouad Sadiq',
            'email' => 'mona.fouad.fake@eecegypt.com',
            'code' => '7',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير شؤون الأفراد',
            'position_en' => 'Personnel Manager',
            'manager_id' => $CorporatePlanningAndDevelopmentHead->id,
            'sector_id' => $corporatePlanningDevelopmentSector->id,
        ]);
        $personnelDepartment = Department::create([
            'name_ar' => 'شؤون الأفراد',
            'name_en' => 'Personnel',
            'sector_id' => $corporatePlanningDevelopmentSector->id,
            'manager_id' => $personnelManager->id,
            'delegated_id' => 1,
        ]);
        $personnelManager->update([
            'sector_id'  => $corporatePlanningDevelopmentSector->id,
            'department_id' => $personnelDepartment->id
        ]);

        // Marketing 
        $personnelManager = User::create([
            'username' => '?1',
            'name_ar' => '?1',
            'name_en' => '?1',
            'email' => '?1.fake@eecegypt.com',
            'code' => '0000-0009',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير تسويق',
            'position_en' => 'Marketing Manager',
            'manager_id' => $CorporatePlanningAndDevelopmentHead->id,
            'sector_id' => $corporatePlanningDevelopmentSector->id,
        ]);
        $personnelDepartment = Department::create([
            'name_ar' => 'تسويق',
            'name_en' => 'Marketing',
            'sector_id' => $corporatePlanningDevelopmentSector->id,
            'manager_id' => $personnelManager->id,
            'delegated_id' => 1,
        ]);
        $personnelManager->update([
            'sector_id'  => $corporatePlanningDevelopmentSector->id,
            'department_id' => $personnelDepartment->id
        ]);
        // Corporate Planning & Development sector Employees
        // -------------------------------- END Corporate Planning & Development Sector --------------------------------



        // -------------------------------- START Accounts, Audit & Inventory Sector --------------------------------
        $accountsAuditAndInventorySector = Sector::create([
            'name_ar' => 'الحسابات والمراجعة والمخازن',
            'name_en' => 'Accounts, Audit & Inventory',
            'head_id' => $accountsAuditAndInventoryHead->id,
            'delegated_id' => 1
        ]);
        $accountsAuditAndInventoryHead->update([
            'sector_id'  => $accountsAuditAndInventorySector->id,
        ]);
        // Accounts, Audit & Inventory sector Departments
        // Accounts payable
        $accountsPayableManager = User::create([
            'username' => 'karim.mohamed',
            'name_ar' => 'كريم محمد على صالح',
            'name_en' => 'karim Mohamed Ali Saleh',
            'email' => 'karim.mohamed.fake@eecegypt.com',
            'code' => '313',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير مساعد حسابات ( العملاء )',
            'position_en' => 'Accounts Assistant Manager (Customers)',
            'manager_id' => $accountsAuditAndInventoryHead->id,
            'sector_id' => $accountsAuditAndInventorySector->id,
        ]);
        $accountsPayableDepartment = Department::create([
            'name_ar' => 'الحسابات الدائنة',
            'name_en' => 'Accounts Payable',
            'sector_id' => $accountsAuditAndInventorySector->id,
            'manager_id' => $accountsPayableManager->id,
            'delegated_id' => 1,
        ]);
        $accountsPayableManager->update([
            'sector_id'  => $accountsAuditAndInventorySector->id,
            'department_id' => $accountsPayableDepartment->id
        ]);

        // Accounting
        $accountingManager = User::create([
            'username' => 'samer',
            'name_ar' => 'سمير',
            'name_en' => 'Samer',
            'email' => 'samer.fake@eecegypt.com',
            'code' => '0000',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير حسابات',
            'position_en' => 'Accounting Manager',
            'manager_id' => $accountsAuditAndInventoryHead->id,
            'sector_id' => $accountsAuditAndInventorySector->id,
        ]);
        $accountingDepartment = Department::create([
            'name_ar' => 'الحسابات',
            'name_en' => 'Accounting',
            'sector_id' => $accountsAuditAndInventorySector->id,
            'manager_id' => $accountingManager->id,
            'delegated_id' => 1,
        ]);
        $accountingManager->update([
            'sector_id'  => $accountsAuditAndInventorySector->id,
            'department_id' => $accountingDepartment->id
        ]);


        // Cost
        $costManager = User::create([
            'username' => 'remon',
            'name_ar' => 'ريمون',
            'name_en' => 'Remon',
            'email' => 'remon.fake@eecegypt.com',
            'code' => '0000-001',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير التكاليف',
            'position_en' => 'Cost Manager',
            'manager_id' => $accountsAuditAndInventoryHead->id,
            'sector_id' => $accountsAuditAndInventorySector->id,
        ]);
        $costDepartment = Department::create([
            'name_ar' => 'الحسابات',
            'name_en' => 'Cost',
            'sector_id' => $accountsAuditAndInventorySector->id,
            'manager_id' => $costManager->id,
            'delegated_id' => 1,
        ]);
        $costManager->update([
            'sector_id'  => $accountsAuditAndInventorySector->id,
            'department_id' => $costDepartment->id
        ]);

        // Audit
        $auditManager = User::create([
            'username' => 'wael',
            'name_ar' => 'وائل',
            'name_en' => 'Wael',
            'email' => 'wael.fake@eecegypt.com',
            'code' => '0000-002',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير المراجعة',
            'position_en' => 'Audit Manager',
            'manager_id' => $accountsAuditAndInventoryHead->id,
            'sector_id' => $accountsAuditAndInventorySector->id,
        ]);
        $auditDepartment = Department::create([
            'name_ar' => 'المراجعة',
            'name_en' => 'Audit',
            'sector_id' => $accountsAuditAndInventorySector->id,
            'manager_id' => $auditManager->id,
            'delegated_id' => 1,
        ]);
        $auditManager->update([
            'sector_id'  => $accountsAuditAndInventorySector->id,
            'department_id' => $auditDepartment->id
        ]);

        // Cash Room
        $cashRoomManager = User::create([
            'username' => 'mina',
            'name_ar' => 'مينا',
            'name_en' => 'Mina',
            'email' => 'mina.fake@eecegypt.com',
            'code' => '0000-003',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير غرفة النقدية',
            'position_en' => 'Cash Room Manager',
            'manager_id' => $accountsAuditAndInventoryHead->id,
            'sector_id' => $accountsAuditAndInventorySector->id,
        ]);
        $cashRoomDepartment = Department::create([
            'name_ar' => 'غرفة النقدية',
            'name_en' => 'Cash Room',
            'sector_id' => $accountsAuditAndInventorySector->id,
            'manager_id' => $cashRoomManager->id,
            'delegated_id' => 1,
        ]);
        $cashRoomManager->update([
            'sector_id'  => $accountsAuditAndInventorySector->id,
            'department_id' => $cashRoomDepartment->id
        ]);

        // Payroll
        $payrollManager = User::create([
            'username' => 'fiby',
            'name_ar' => 'فيبى',
            'name_en' => 'Fiby',
            'email' => 'fiby.fake@eecegypt.com',
            'code' => '0000-004',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير المرتبات',
            'position_en' => 'Payroll Manager',
            'manager_id' => $accountsAuditAndInventoryHead->id,
            'sector_id' => $accountsAuditAndInventorySector->id,
        ]);
        $payrollDepartment = Department::create([
            'name_ar' => 'المرتبات',
            'name_en' => 'Payroll',
            'sector_id' => $accountsAuditAndInventorySector->id,
            'manager_id' => $payrollManager->id,
            'delegated_id' => 1,
        ]);
        $payrollManager->update([
            'sector_id'  => $accountsAuditAndInventorySector->id,
            'department_id' => $payrollDepartment->id
        ]);

        // Taxation
        $taxationManager = User::create([
            'username' => 'nermine',
            'name_ar' => 'نرمين',
            'name_en' => 'Nermine',
            'email' => 'nermine.fake@eecegypt.com',
            'code' => '0000-005',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير الضرائب',
            'position_en' => 'Taxation Manager',
            'manager_id' => $accountsAuditAndInventoryHead->id,
            'sector_id' => $accountsAuditAndInventorySector->id,
        ]);
        $taxationDepartment = Department::create([
            'name_ar' => 'الضرائب',
            'name_en' => 'Taxation',
            'sector_id' => $accountsAuditAndInventorySector->id,
            'manager_id' => $taxationManager->id,
            'delegated_id' => 1,
        ]);
        $taxationManager->update([
            'sector_id'  => $accountsAuditAndInventorySector->id,
            'department_id' => $taxationDepartment->id
        ]);

        // Accounts, Audit & Inventory sector Employees
        // -------------------------------- END Accounts, Audit & Inventory Sector --------------------------------

        // -------------------------------- START Business Development Sector --------------------------------
        // Samer Labib Halim (214)
        $businessDevelopmentHead = User::create([
            'username' => 'samer.labib',
            'name_ar' => 'سامر لبيب حليم',
            'name_en' => 'Samer Labib Halim',
            'email' => 'samer.labib.halim.fake@eecegypt.com',
            'code' => '214',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيس قطاع تطوير الاعمال',
            'position_en' => 'Head of Business Development',
            'board_member' => 1,
        ]);
        $businessDevelopmentSector = Sector::create([
            'name_ar' => 'تطوير الاعمال',
            'name_en' => 'Business Development',
            'head_id' => $businessDevelopmentHead->id,
            'delegated_id' => 1
        ]);
        $businessDevelopmentHead->update([
            'sector_id'  => $businessDevelopmentSector->id,
        ]);
        // Accounts, Audit & Inventory sector Departments
        // Tendering
        $tenderingManager = User::create([
            'username' => 'fady',
            'name_ar' => 'فادى',
            'name_en' => 'Fady',
            'email' => 'fady.fake@eecegypt.com',
            'code' => '0000-006',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير المناقصات',
            'position_en' => 'Tendering Manager',
            'manager_id' => $businessDevelopmentHead->id,
            'sector_id' => $businessDevelopmentSector->id,
        ]);
        $tenderingDepartment = Department::create([
            'name_ar' => 'المناقصات',
            'name_en' => 'Tendering',
            'sector_id' => $businessDevelopmentSector->id,
            'manager_id' => $tenderingManager->id,
            'delegated_id' => 1,
        ]);
        $tenderingManager->update([
            'sector_id'  => $businessDevelopmentSector->id,
            'department_id' => $tenderingDepartment->id
        ]);

        // New Business
        $newBusinessManager = User::create([
            'username' => '؟',
            'name_ar' => '؟',
            'name_en' => '؟',
            'email' => '؟.fake@eecegypt.com',
            'code' => '0000-007',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير أعمال جديدة',
            'position_en' => 'New Business Manager',
            'manager_id' => $businessDevelopmentHead->id,
            'sector_id' => $businessDevelopmentSector->id,
        ]);
        $newBusinessDepartment = Department::create([
            'name_ar' => 'أعمال جديدة',
            'name_en' => 'New Business',
            'sector_id' => $businessDevelopmentSector->id,
            'manager_id' => $newBusinessManager->id,
            'delegated_id' => 1,
        ]);
        $newBusinessManager->update([
            'sector_id'  => $businessDevelopmentSector->id,
            'department_id' => $newBusinessDepartment->id
        ]);

        // Design
        $designManager = User::create([
            'username' => 'ehab',
            'name_ar' => 'ايهاب',
            'name_en' => 'Ehab',
            'email' => 'ehab.fake@eecegypt.com',
            'code' => '0000-008',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير التصميم',
            'position_en' => 'Design Manager',
            'manager_id' => $businessDevelopmentHead->id,
            'sector_id' => $businessDevelopmentSector->id,
        ]);
        $designDepartment = Department::create([
            'name_ar' => 'التصميم',
            'name_en' => 'Design',
            'sector_id' => $businessDevelopmentSector->id,
            'manager_id' => $designManager->id,
            'delegated_id' => 1,
        ]);
        $designManager->update([
            'sector_id'  => $businessDevelopmentSector->id,
            'department_id' => $designDepartment->id
        ]);
        // Accounts, Audit & Inventory sector Employees
        // -------------------------------- END Accounts, Audit & Inventory Sector --------------------------------



        // -------------------------------- START Construction Planning --------------------------------
        // Sherif (34)
        // $constructionPlanningHead = User::create([
        //     'username' => 'Sherif',
        //     'name_ar' => 'شريف',
        //     'name_en' => 'Sherif',
        //     'email' => 'Sherif.fake@eecegypt.com',
        //     'code' => '34',
        //     'password' => bcrypt('123456'),
        //     'position_ar' => 'رئيس قطاع شرق ( عضو مجلس الادارة )   رئيسا للادارة المركزية للتعاقدات مع مقاولى الباطن )',
        //     'position_en' => 'Head of East Region & the Central Department for Contracting with Subcontractors',
        //     'board_member' => 1,
        // ]);
        // $constructionPlanningSector = Sector::create([
        //     'name_ar' => 'انشاءات2',
        //     'name_en' => 'ConstructionPlanning',
        //     'head_id' => $constructionPlanningHead->id,
        //     'delegated_id' => 1
        // ]);
        // $constructionPlanningHead->update([
        //     'sector_id'  => $constructionPlanningSector->id,
        // ]);
        // ConstructionPlanning Departments
        // ConstructionPlanning Employees
        // -------------------------------- END Construction Planning --------------------------------





        // -------------------------------- START Purchasing Sector --------------------------------
        // Michel Gerges Michael Tadros (10)
        $purchasingHead = User::create([
            'username' => 'michel.gerges',
            'name_ar' => 'ميشيل جرجس ميخائيل تادرس',
            'name_en' => 'Michel Gerges Michael Tadros',
            'email' => 'michel.gerges.michael.tadros.fake@eecegypt.com',
            'code' => '10',
            'password' => bcrypt('123456'),
            'position_ar' => 'نائب رئيس مجلس الادارة شئون المشتريات الداخلية والخارجية وتعاقدات مقاولى الباطن، المشروعات الداخلية والمكتب الفنى للأعمال المدنية',
            'position_en' => 'Vice President - Procurement, Subcontractor Management, Internal Projects & Technical office (Civil)',
            'board_member' => 1,
        ]);
        $purchasingSector = Sector::create([
            'name_ar' => 'المشتريات',
            'name_en' => 'Purchasing',
            'head_id' => $purchasingHead->id,
            'delegated_id' => 1
        ]);
        $purchasingHead->update([
            'sector_id'  => $purchasingSector->id,
        ]);

        // Purchasing sector Departments
        $internalPurchasingManager = User::create([
            'username' => 'atef.rady',
            'name_ar' => 'عاطف راضى تقاوى',
            'name_en' => 'Atef Rady Taqawy',
            'email' => 'atef.rady.fake@eecegypt.com',
            'code' => '91',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير المشتريات الداخلية',
            'position_en' => 'Internal Purchasing Manager',
            'manager_id' => $purchasingHead->id,
            'sector_id' => $purchasingSector->id,
        ]);
        $internalPurchasingDepartment = Department::create([
            'name_ar' => 'المشتريات الداخلية',
            'name_en' => 'Internal Purchasing',
            'sector_id' => $purchasingSector->id,
            'manager_id' => $internalPurchasingManager->id,
            'delegated_id' => 1,
        ]);
        $internalPurchasingManager->update([
            'sector_id'  => $purchasingSector->id,
            'department_id' => $internalPurchasingDepartment->id
        ]);

        $externalPurchasingManager = User::create([
            'username' => 'peter.maher',
            'name_ar' => 'بيتر ماهر جرجس عبيد',
            'name_en' => 'Peter Maher Gerges Obaid',
            'email' => 'peter.maher.fake@eecegypt.com',
            'code' => '787',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير المشتريات الخارجية',
            'position_en' => 'External Purchasing Manager',
            'manager_id' => $purchasingHead->id,
            'sector_id' => $purchasingSector->id,
        ]);
        $externalPurchasingDepartment = Department::create([
            'name_ar' => 'المشتريات الخارجية',
            'name_en' => 'External Purchasing',
            'sector_id' => $purchasingSector->id,
            'manager_id' => $externalPurchasingManager->id,
            'delegated_id' => 1,
        ]);
        $externalPurchasingManager->update([
            'sector_id'  => $purchasingSector->id,
            'department_id' => $externalPurchasingDepartment->id
        ]);
        // Purchasing sector Employees
        // -------------------------------- END Purchasing Sector --------------------------------




        // -------------------------------- START Civil Technical Office Sector --------------------------------
        // Michel Gerges Michael Tadros (10)
        $civilTechnicalOfficeSector = Sector::create([
            'name_ar' => 'المكتب الفني المدني',
            'name_en' => 'Civil Technical Office',
            'head_id' => $purchasingHead->id,
            'delegated_id' => 1
        ]);

        // Purchasing sector Departments
        $civilTechnicalOfficeManager = User::create([
            'username' => 'sally.adel',
            'name_ar' => 'سالى عادل انور مسعد',
            'name_en' => 'Sally Adel Anwar Massad',
            'email' => 'sally.adel.fake@eecegypt.com',
            'code' => '2410',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير المكتب الفني المدني',
            'position_en' => 'Civil Technical Office Manager',
            'manager_id' => $purchasingHead->id,
            'sector_id' => $civilTechnicalOfficeSector->id,
        ]);
        $civilTechnicalOfficeDepartment = Department::create([
            'name_ar' => 'المكتب الفني المدني',
            'name_en' => 'Civil Technical Office',
            'sector_id' => $civilTechnicalOfficeSector->id,
            'manager_id' => $civilTechnicalOfficeManager->id,
            'delegated_id' => 1,
        ]);
        $civilTechnicalOfficeManager->update([
            'sector_id'  => $civilTechnicalOfficeSector->id,
            'department_id' => $civilTechnicalOfficeDepartment->id
        ]);
        // Civil Technical Office Employees
        // -------------------------------- END Civil Technical Office Sector --------------------------------


        // -------------------------------- START Construction Planning Sector --------------------------------
        // Sherif Fouad Farag Al-Khanajry (2787)
        $constructionPlanningHead = User::create([
            'username' => 'sherif.fouad',
            'name_ar' => 'شريف فؤاد فرج الخناجرى',
            'name_en' => 'Sherif Fouad Farag Al-Khanajry',
            'email' => 'sherif.fouad.fake@eecegypt.com',
            'code' => '2787',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيسا لقطاع التخطيط ومتابعة الاداء والمكتب الفنى الكتروميكانيكال ',
            'position_en' => 'Head of the Planning and Performance Follow-up Sector and the Electromechanical Technical Office',
        ]);
        $purchasingSector = Sector::create([
            'name_ar' => 'تخطيط الإنشاء',
            'name_en' => 'Construction Planning',
            'head_id' => $constructionPlanningHead->id,
            'delegated_id' => 1
        ]);
        $constructionPlanningHead->update([
            'sector_id'  => $purchasingSector->id,
        ]);

        // Construction Planning sector Departments
        $internalPurchasingManager = User::create([
            'username' => 'tawansy',
            'name_ar' => 'توانسى',
            'name_en' => 'Tawansy',
            'email' => 'tawansy.fake@eecegypt.com',
            'code' => '0000-015',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير المشتريات الداخلية',
            'position_en' => 'Internal Purchasing Manager',
            'manager_id' => $constructionPlanningHead->id,
            'sector_id' => $purchasingSector->id,
        ]);
        $internalPurchasingDepartment = Department::create([
            'name_ar' => 'تخطيط و متابعة الإنشاء',
            'name_en' => 'Construction Planning & Follow Up',
            'sector_id' => $purchasingSector->id,
            'manager_id' => $internalPurchasingManager->id,
            'delegated_id' => 1,
        ]);
        $internalPurchasingManager->update([
            'sector_id'  => $purchasingSector->id,
            'department_id' => $internalPurchasingDepartment->id
        ]);
        // Construction Planning sector Employees
        // -------------------------------- END Construction Planning Sector --------------------------------



        // -------------------------------- START MEP Technical Office Sector --------------------------------
        $MEPTechnicalOfficeSector = Sector::create([
            'name_ar' => 'المكتب الفني للميكانيكا والكهرباء والسباكة',
            'name_en' => 'MEP Technical Office',
            'head_id' => $constructionPlanningHead->id,
            'delegated_id' => 1
        ]);

        // Purchasing sector Departments
        $MEPTechnicalOfficeManager = User::create([
            'username' => 'aiman',
            'name_ar' => 'ايمن',
            'name_en' => 'Aiman',
            'email' => 'aiman.fake@eecegypt.com',
            'code' => '0000-016',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير المكتب الفني للميكانيكا والكهرباء والسباكة',
            'position_en' => 'MEP Technical Office Manager',
            'manager_id' => $constructionPlanningHead->id,
            'sector_id' => $MEPTechnicalOfficeSector->id,
        ]);
        $MEPTechnicalOfficeDepartment = Department::create([
            'name_ar' => 'المكتب الفني للميكانيكا والكهرباء والسباكة',
            'name_en' => 'MEP Technical Office',
            'sector_id' => $MEPTechnicalOfficeSector->id,
            'manager_id' => $MEPTechnicalOfficeManager->id,
            'delegated_id' => 1,
        ]);
        $MEPTechnicalOfficeManager->update([
            'sector_id'  => $MEPTechnicalOfficeSector->id,
            'department_id' => $MEPTechnicalOfficeDepartment->id
        ]);
        // MEP Technical Office Employees
        // -------------------------------- END MEP Technical Office Sector --------------------------------



        // -------------------------------- START Subcontractors Management Sector --------------------------------
        // 
        $subcontractorsManagementHead = User::create([
            'username' => 'tarek',
            'name_ar' => 'طارق',
            'name_en' => 'Tarek',
            'email' => 'tarek.fake@eecegypt.com',
            'code' => '0000-017',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيسا لقطاع إدارة مقاولي الباطن',
            'position_en' => 'Head of Subcontractors Management',
        ]);

        $subcontractorsManagementSector = Sector::create([
            'name_ar' => 'إدارة مقاولي الباطن',
            'name_en' => 'Subcontractors Management',
            'head_id' => $subcontractorsManagementHead->id,
            'delegated_id' => 1
        ]);

        $subcontractorsManagementHead->update([
            'sector_id'  => $subcontractorsManagementSector->id,
        ]);

        // Purchasing sector Departments
        $subcontractorsManagementManager = User::create([
            'username' => 'bassem',
            'name_ar' => 'باسم',
            'name_en' => 'Bassem',
            'email' => 'bassem.fake@eecegypt.com',
            'code' => '0000-018',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير إدارة مقاولي الباطن',
            'position_en' => 'Subcontractors Management Manager',
            'manager_id' => $subcontractorsManagementHead->id,
            'sector_id' => $subcontractorsManagementSector->id,
        ]);
        $subcontractorsManagementDepartment = Department::create([
            'name_ar' => 'إدارة مقاولي الباطن',
            'name_en' => 'Subcontractors Management',
            'sector_id' => $subcontractorsManagementSector->id,
            'manager_id' => $subcontractorsManagementManager->id,
            'delegated_id' => 1,
        ]);
        $subcontractorsManagementManager->update([
            'sector_id'  => $subcontractorsManagementSector->id,
            'department_id' => $subcontractorsManagementDepartment->id
        ]);
        // Subcontractors Management Employees
        // -------------------------------- END Subcontractors Management Sector --------------------------------



        // -------------------------------- START Military Signal Sector --------------------------------
        // 
        $militarySignalHead = User::create([
            'username' => 'eshak',
            'name_ar' => 'اسحاق',
            'name_en' => 'Eshak',
            'email' => 'eshak.fake@eecegypt.com',
            'code' => '0000-019',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيسا لقطاع الإشارة العسكرية',
            'position_en' => 'Head of Military Signal',
        ]);

        $militarySignalSector = Sector::create([
            'name_ar' => 'الإشارة العسكرية',
            'name_en' => 'Military Signal',
            'head_id' => $militarySignalHead->id,
            'delegated_id' => 1
        ]);

        $militarySignalHead->update([
            'sector_id'  => $militarySignalSector->id,
        ]);

        // Purchasing sector Departments
        $militarySignalManager = User::create([
            'username' => 'joseph',
            'name_ar' => 'يوسف',
            'name_en' => 'Joseph',
            'email' => 'joseph.fake@eecegypt.com',
            'code' => '0000-020',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير الإشارة العسكرية',
            'position_en' => 'Military Signal Manager',
            'manager_id' => $militarySignalHead->id,
            'sector_id' => $militarySignalSector->id,
        ]);
        $militarySignalDepartment = Department::create([
            'name_ar' => 'الإشارة العسكرية',
            'name_en' => 'Military Signal',
            'sector_id' => $militarySignalSector->id,
            'manager_id' => $militarySignalManager->id,
            'delegated_id' => 1,
        ]);
        $militarySignalManager->update([
            'sector_id'  => $militarySignalSector->id,
            'department_id' => $militarySignalDepartment->id
        ]);
        // Military Signal Employees
        // -------------------------------- END Military Signal Sector --------------------------------



        // -------------------------------- START Construction1 --------------------------------
        // Tariq Jamil Wahib (11)
        $construction1Head = User::create([
            'username' => 'tariq.jamil',
            'name_ar' => 'طارق جميل وهيب',
            'name_en' => 'Tariq Jamil Wahib',
            'email' => 'tariq.jamil.fake@eecegypt.com',
            'code' => '11',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيس قطاع غرب ( عضو مجلس الادارة )   رئيسا للادارة المركزية للتعاقدات مع مقاولى الباطن )',
            'position_en' => 'Head of West Region & the Central Department for Contracting with Subcontractors',
            'board_member' => 1,
        ]);
        $construction1Sector = Sector::create([
            'name_ar' => 'انشاءات #1',
            'name_en' => 'Construction #1',
            'head_id' => $construction1Head->id,
            'delegated_id' => 1
        ]);
        $construction1Head->update([
            'sector_id'  => $construction1Sector->id,
        ]);
        // Construction1 Projects
        $wadiElNatrunManager = User::create([
            'username' => '?3',
            'name_ar' => '?3',
            'name_en' => '?3',
            'email' => '?3.fake@eecegypt.com',
            'code' => '0000-012',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير مشروع وادى النطرون',
            'position_en' => 'Wadi El Natrun project manager',
            'sector_id' => $construction1Sector->id,
            'manager_id' => $construction1Head->id
        ]);

        $WadiElNatrunProject = Project::create([
            'name_ar' => 'وادى النطرون',
            'name_en' => 'Wadi El Natrun',
            'description_ar' => 'وصف وادى النطرون',
            'description_en' => 'Wadi El Natrun description',
            'sector_id' => $construction1Sector->id,
            'group_id' => 2, // Construction - MEP
            'manager_id' => $wadiElNatrunManager->id,
            'delegated_id' => 1,
        ]);

        User::create([
            'username' => 'employee.test.WadiElNatrun',
            'name_ar' => 'موظف اختبار مشروع وادى النطرون',
            'name_en' => 'Employee Test Wadi El Natrun',
            'email' => 'employee.test.WadiElNatrun.fake@eecegypt.com',
            'code' => '0000-100',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف',
            'position_en' => 'Employee',
            'sector_id' => $construction1Sector->id,
            'project_id' => $WadiElNatrunProject->id,
            'manager_id' => $wadiElNatrunManager->id,
        ]);

        $EJUSTManager = User::create([
            'username' => '?4',
            'name_ar' => '?4',
            'name_en' => '?4',
            'email' => '?4.fake@eecegypt.com',
            'code' => '0000-013',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير مشروع EJUST',
            'position_en' => 'Military Colleges project manager',
            'sector_id' => 1,
            'manager_id' => $construction1Head->id
        ]);

        $EJUSTProject = Project::create([
            'name_ar' => 'EJUST',
            'name_en' => 'EJUST',
            'description_ar' => 'وصف EJUST',
            'description_en' => 'EJUST description',
            'sector_id' => $construction1Sector->id,
            'group_id' => 2, // Construction - MEP
            'manager_id' => $EJUSTManager->id,
            'delegated_id' => 1,
        ]);

        User::create([
            'username' => 'employee.test.EJUST',
            'name_ar' => 'موظف اختبار مشروع EJUST',
            'name_en' => 'Employee Test EJUST',
            'email' => 'employee.test.EJUST.fake@eecegypt.com',
            'code' => '0000-101',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف',
            'position_en' => 'Employee',
            'sector_id' => $construction1Sector->id,
            'project_id' => $EJUSTProject->id,
            'manager_id' => $EJUSTManager->id,
        ]);
        // Construction1 Employees
        // -------------------------------- END Construction1 --------------------------------

        // -------------------------------- START Construction2 --------------------------------
        // Nashaat Makeen Qaldas (34)
        $construction2Head = User::create([
            'username' => 'nashaat.makeen',
            'name_ar' => 'نشأت مكين قلدس',
            'name_en' => 'Nashaat Makeen Qaldas',
            'email' => 'nashaat.makeen.fake@eecegypt.com',
            'code' => '34',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيس قطاع شرق ( عضو مجلس الادارة )   رئيسا للادارة المركزية للتعاقدات مع مقاولى الباطن )',
            'position_en' => 'Head of East Region & the Central Department for Contracting with Subcontractors',
            'board_member' => 1,
        ]);
        $construction2Sector = Sector::create([
            'name_ar' => 'انشاءات #2',
            'name_en' => 'Construction #2',
            'head_id' => $construction2Head->id,
            'delegated_id' => 1
        ]);
        $construction2Head->update([
            'sector_id'  => $construction2Sector->id,
        ]);
        // Construction2 Projects
        $militaryCollegesManager = User::create([
            'username' => 'eldieb',
            'name_ar' => 'الديب',
            'name_en' => 'El Dieb',
            'email' => 'eldieb.fake@eecegypt.com',
            'code' => '0000-014',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير مشروع الكليات العسكرية',
            'position_en' => 'Military Colleges project manager',
            'sector_id' => 1,
            'manager_id' => $construction2Head->id
        ]);

        $militaryCollegesProject = Project::create([
            'name_ar' => 'الكليات العسكرية',
            'name_en' => 'Military Colleges',
            'description_ar' => 'وصف الكليات العسكرية',
            'description_en' => 'Military Colleges description',
            'sector_id' => $construction2Sector->id,
            'group_id' => 2, // Construction - MEP
            'manager_id' => $militaryCollegesManager->id,
            'delegated_id' => 1,
        ]);

        User::create([
            'username' => 'employee.test.militaryColleges',
            'name_ar' => 'موظف اختبار مشروع military Colleges',
            'name_en' => 'Employee Test military Colleges',
            'email' => 'employee.test.militaryColleges.fake@eecegypt.com',
            'code' => '0000-102',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف',
            'position_en' => 'Employee',
            'sector_id' => $construction2Sector->id,
            'project_id' => $militaryCollegesProject->id,
            'manager_id' => $militaryCollegesManager->id,
        ]);

        $haikstepManager = User::create([
            'username' => 'sherif',
            'name_ar' => 'شريف',
            'name_en' => 'Sherif',
            'email' => 'sherif.fake@eecegypt.com',
            'code' => '0000-011',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير مشروع الهايكستب',
            'position_en' => 'Haikstep project manager',
            'sector_id' => 1,
            'manager_id' => $construction2Head->id
        ]);

        $haikstepProject = Project::create([
            'name_ar' => 'الهايكستب',
            'name_en' => 'Haikstep',
            'description_ar' => 'وصف الهايكستب',
            'description_en' => 'Haikstep description',
            'sector_id' => $construction2Sector->id,
            'group_id' => 2, // Construction - MEP
            'manager_id' => $haikstepManager->id,
            'delegated_id' => 1,
        ]);

        User::create([
            'username' => 'employee.test.$haikstep',
            'name_ar' => 'موظف اختبار مشروع haikstep',
            'name_en' => 'Employee Test haikstep',
            'email' => 'employee.test.haikstep.fake@eecegypt.com',
            'code' => '0000-103',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف',
            'position_en' => 'Employee',
            'sector_id' => $construction2Sector->id,
            'project_id' => $haikstepProject->id,
            'manager_id' => $haikstepManager->id,
        ]);
        // Construction2 Employees
        // -------------------------------- END Construction2 --------------------------------

        // -------------------------------- START Construction3 --------------------------------
        // Ahmed Mahmoud Amin Hassanein (39)
        $construction3Head = User::create([
            'username' => 'ahmed.mahmoud',
            'name_ar' => 'احمد محمود امين حسنين',
            'name_en' => 'Ahmed Mahmoud Amin Hassanein',
            'email' => 'ahmed.mahmoud.fake@eecegypt.com',
            'code' => '39',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيس قطاع جنوب',
            'position_en' => 'Head of South Region',
            'board_member' => 1,
        ]);
        $construction3Sector = Sector::create([
            'name_ar' => 'انشاءات #3',
            'name_en' => 'Construction #3',
            'head_id' => $construction3Head->id,
            'delegated_id' => 1
        ]);
        $construction3Head->update([
            'sector_id'  => $construction3Sector->id,
        ]);
        // Construction3 Projects
        $meniaUniversityManager = User::create([
            'username' => '?2',
            'name_ar' => '?2',
            'name_en' => '?2',
            'email' => '?2.fake@eecegypt.com',
            'code' => '0000-010',
            'password' => bcrypt('123456'),
            'position_ar' => '?2',
            'position_en' => '?2',
            'sector_id' => 1,
            'manager_id' => $construction3Head->id
        ]);

        $meniaUniversityProject = Project::create([
            'name_ar' => 'جامعة المنيا',
            'name_en' => 'Menia University',
            'description_ar' => 'وصف جامعة المنيا',
            'description_en' => 'Menia university description',
            'sector_id' => $construction3Sector->id,
            'group_id' => 2, // Construction - MEP
            'manager_id' => $meniaUniversityManager->id,
            'delegated_id' => 1,
        ]);

        User::create([
            'username' => 'employee.test.meniaUniversity',
            'name_ar' => 'موظف اختبار مشروع meniaUniversity',
            'name_en' => 'Employee Test meniaUniversity',
            'email' => 'employee.test.meniaUniversity.fake@eecegypt.com',
            'code' => '0000-104',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف',
            'position_en' => 'Employee',
            'sector_id' => $construction3Sector->id,
            'project_id' => $meniaUniversityProject->id,
            'manager_id' => $meniaUniversityManager->id,
        ]);
        // Construction3 Employees
        // -------------------------------- END Construction3 --------------------------------

        // -------------------------------- START SteelErection --------------------------------
        // Abdel Qader Mohamed Ahmed Heikal (2868)
        $steelErectionHead = User::create([
            'username' => 'abdelqader.mohamed',
            'name_ar' => 'عبد القادر محمد احمد هيكل',
            'name_en' => 'Abdel Qader Mohamed Ahmed Heikal',
            'email' => 'abdelqader.mohamed.fake@eecegypt.com',
            'code' => '2868',
            'password' => bcrypt('123456'),
            'position_ar' => 'رئيس قطاع التشييد معدنى',
            'position_en' => 'Head of Steel Erection',
            'board_member' => 1,
        ]);
        $steelErectionSector = Sector::create([
            'name_ar' => 'التشييد معدنى',
            'name_en' => 'Steel Erection',
            'head_id' => $steelErectionHead->id,
            'delegated_id' => 1
        ]);
        $steelErectionHead->update([
            'sector_id'  => $steelErectionSector->id,
        ]);
        // SteelErection Departments
        // SteelErection Employees
        // -------------------------------- END SteelErection --------------------------------


        // -------------------------------- START Network --------------------------------
        // Abdel Qader Mohamed Ahmed Heikal (2868)
        $networkSector = Sector::create([
            'name_ar' => 'الشبكات',
            'name_en' => 'Networks',
            'head_id' => $purchasingHead->id,
            'delegated_id' => 1
        ]);
        // Network Departments

        // Networks And Installations Departments
        $networksAndInstallationsManager = User::create([
            'username' => 'Amjad.halim',
            'name_ar' => 'امجد حليم غبريال',
            'name_en' => 'Amjad Halim Ghobriel',
            'email' => 'Amjad.halim.fake@eecegypt.com',
            'code' => '614',
            'password' => bcrypt('123456'),
            'position_ar' => 'مدير الشبكات والتركيبات',
            'position_en' => 'External Purchasing Manager',
            'manager_id' => $purchasingHead->id,
            'sector_id'  => $networkSector->id,
        ]);
        // $networksAndInstallationsDepartment = Department::create([
        //     'name_ar' => 'الشبكات والتركيبات',
        //     'name_en' => 'Networks and installations',
        //     'sector_id' => $networkSector->id,
        //     'manager_id' => $networksAndInstallationsManager->id,
        //     'delegated_id' => 1,
        // ]);
        // $networksAndInstallationsManager->update([
        //     'department_id' => $networksAndInstallationsDepartment->id
        // ]);
        // Networks And Installations Projects

        $mobinilProject = Project::create([
            'name_ar' => 'موبينيل',
            'name_en' => 'Mobinil',
            'description_ar' => 'وصف مشروع موبينيل',
            'description_en' => 'Mobinil project description',
            'sector_id' => $networkSector->id,
            'group_id' => 2, // Construction - MEP
            'manager_id' => $networksAndInstallationsManager->id,
            'delegated_id' => 1,
        ]);

        User::create([
            'username' => 'employee.test.mobinil',
            'name_ar' => 'موظف اختبار مشروع mobinil',
            'name_en' => 'Employee Test mobinil',
            'email' => 'employee.test.mobinil.fake@eecegypt.com',
            'code' => '0000-105',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف',
            'position_en' => 'Employee',
            'sector_id' => $networkSector->id,
            'project_id' => $mobinilProject->id,
            'manager_id' => $networksAndInstallationsManager->id
        ]);

        $etisalatProject = Project::create([
            'name_ar' => 'إتصالات',
            'name_en' => 'Etisalat',
            'description_ar' => 'وصف مشروع إتصالات',
            'description_en' => 'Etisalat project description',
            'sector_id' => $networkSector->id,
            'group_id' => 2, // Construction - MEP
            'manager_id' => $networksAndInstallationsManager->id,
            'delegated_id' => 1,
        ]);

        User::create([
            'username' => 'employee.test.etisalat',
            'name_ar' => 'موظف اختبار مشروع etisalat',
            'name_en' => 'Employee Test etisalat',
            'email' => 'employee.test.etisalat.fake@eecegypt.com',
            'code' => '0000-106',
            'password' => bcrypt('123456'),
            'position_ar' => 'موظف',
            'position_en' => 'Employee',
            'sector_id' => $networkSector->id,
            'project_id' => $etisalatProject->id,
            'manager_id' => $networksAndInstallationsManager->id
        ]);
        // Network Employees
        // -------------------------------- END Network --------------------------------

        // -------------------------------- Start Sector --------------------------------
        // for ($i = 1; $i <= 5; $i++) {
        //     $head = User::where('code', '1000' . $i)->first();
        //     $sector = Sector::create([
        //         'name_ar' => 'قطاع' . $i,
        //         'name_en' => 'Sector' . $i,
        //         'head_id' => $head->id,
        //         'delegated_id' => 1
        //     ]);

        //     $head->update([
        //         'sector_id'  => $sector->id,
        //     ]);
        // }




        // -------------------------------- END Sector --------------------------------

        // -------------------------------- START Department --------------------------------
        // for ($i = 1; $i < 10; $i++) {
        //     $manager = User::where('code', '2000' . $i)->first();

        //     $department = Department::create([
        //         'name_ar' => 'قسم' . $i,
        //         'name_en' => 'Department' . $i,
        //         'sector_id' => ($i % 2) + 1,
        //         'manager_id' => $manager->id,
        //         'delegated_id' => 1,
        //     ]);

        //     $manager->update([
        //         'sector_id'  => ($i % 2) + 1,
        //         'department_id' => $department->id
        //     ]);
        // }

        // // Start IT Department
        // $department = Department::create([
        //     'name_ar' => 'تكنولوجيا المعلومات',
        //     'name_en' => 'IT',
        //     'sector_id' => 1,
        //     'manager_id' => 1,
        //     'delegated_id' => 1,
        // ]);

        // $manager = User::where('id', 1)->first();

        // $manager->update([
        //     'sector_id'  => 1,
        //     'department_id' => 1
        // ]);
        // // End IT Department

        // // Start HR Department
        // $department = Department::create([
        //     'name_ar' => 'الموارد البشرية',
        //     'name_en' => 'Human Resources (HR)',
        //     'sector_id' => 1,
        //     'manager_id' => 1,
        //     'delegated_id' => 1,
        // ]);

        // $manager = User::where('id', 1)->first();

        // $manager->update([
        //     'sector_id'  => 1,
        //     'department_id' => 1
        // ]);
        // // End HR Department

        // // Start Personal Department
        // $department = Department::create([
        //     'name_ar' => 'الموارد البشرية',
        //     'name_en' => 'Personal',
        //     'sector_id' => 1,
        //     'manager_id' => 1,
        //     'delegated_id' => 1,
        // ]);

        // $manager = User::where('id', 1)->first();

        // $manager->update([
        //     'sector_id'  => 1,
        //     'department_id' => 1
        // ]);
        // // End Personal Department

        // // Start Purchasing Department
        // $department = Department::create([
        //     'name_ar' => 'المشتريات',
        //     'name_en' => 'Purchasing',
        //     'sector_id' => 1,
        //     'manager_id' => 1,
        //     'delegated_id' => 1,
        // ]);

        // $manager = User::where('id', 1)->first();

        // $manager->update([
        //     'sector_id'  => 1,
        //     'department_id' => 1
        // ]);
        // // End Purchasing Department

        // -------------------------------- END Department --------------------------------

    }
}
