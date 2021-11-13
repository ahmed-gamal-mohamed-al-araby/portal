<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\CreateSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Traits\StoreFileTrait;
use App\Traits\ToastrTrait;
use App\Models\Address;
use App\Models\Country;
use App\Models\FamilyName;
use App\Models\FamilyNameSupplier;
use App\Models\Governorate;
use App\Models\PersonSupplier;
use App\Models\SubGroup;
use App\Models\Supplier;
use App\Models\SupplierBankTransfer;
use App\Models\SupplierCheque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SupplierController extends Controller
{
    use StoreFileTrait, ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $suppliers = Supplier::paginate(env('PAGINATION_LENGTH', 5));
        $subGroups  = SubGroup::all();
        return view('dashboard-views.supplier.index', compact('suppliers', 'subGroups'));
    }
    public function search()
    {
        $suppliers = Supplier::with("address")->paginate(env('PAGINATION_LENGTH', 5));
        $subGroups  = SubGroup::all();
        $family_names = FamilyName::all();
        return view('dashboard-views.supplier.search', compact('suppliers', 'subGroups', "family_names"));
    }

    public function search_fetch(Request $request)
    {
        $pageType = "index";
        $sup_id = [];
       if($request->ajax()) {
        if($request->job )
        $sup_id =  FamilyNameSupplier::where('family_name_id', 'like', '%' . $request->job . '%')->pluck("supplier_id");
        $suppliers = Supplier::with("familyNames")->
            where(function ($query) use ($request, $sup_id) {
                if($request->name )
                    return $query->where('id',$request->name); 
            })
            ->where(function ($query) use ($request, $sup_id) {
                if($sup_id)
                    return $query->whereIn('id',$sup_id);
            })->get();
       
        return view('dashboard-views.supplier.dataSearch', compact('suppliers', 'pageType'))->render();
       }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $suppliers = Supplier::onlyTrashed()->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.supplier.trash', compact('suppliers'));
    }

    /**
     * Return a view of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    function fetch_data(Request $request)
    {
        // dd($request->all());
        /* Request
        [
            page, // page number
            legnth, // items per page
            search_content,
            page_type => ['index', 'trashed']
        ]
        */

        $length = request()->length ?? env('PAGINATION_LENGTH', 5);
        $searchContent = request()->search_content ?? '';
        $pageType = request()->page_type;
        $sectors = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = Supplier::count();
                }
                if (strlen($searchContent)) {
                    $suppliers = Supplier::where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->paginate($length);
                } else {
                    $suppliers = Supplier::paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = Supplier::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $suppliers = Supplier::onlyTrashed()
                        ->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->paginate($length);
                } else {
                    $suppliers = Supplier::onlyTrashed()->paginate($length);
                }
            }

            return view('dashboard-views.supplier.pagination_data', compact('suppliers', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (count(session()->getOldInput())) {

            $subGroupWithSupplierFamilyNames_id = [];
            $familyNames = FamilyName::whereIn('id', session()->getOldInput()['familyNames'] ?? [])->get();

            foreach ($familyNames as $key => $supplier_familyName) {
                if (isset($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id])) // if sub-group is founded before and set
                    array_push($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id], $supplier_familyName->id);
                else {
                    $subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id] = [];
                    array_push($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id], $supplier_familyName->id);
                }
            }


            $subGroupsWithItsFamilyNames = [];

            foreach (array_keys($subGroupWithSupplierFamilyNames_id) as  $subGroup_id) {
                $subGroupsWithItsFamilyNames[$subGroup_id]['familyNames'] =  SubGroup::find($subGroup_id)->familyNames->toArray();
                $subGroupsWithItsFamilyNames[$subGroup_id]["selectedFamilyNames"] = $subGroupWithSupplierFamilyNames_id[$subGroup_id];
            }

            $tempSubGroups = SubGroup::select('id', 'name_ar', 'name_en')->whereIn('id', array_keys($subGroupWithSupplierFamilyNames_id))->get()->toArray();
            $subGroups = [];
            foreach ($tempSubGroups as $key => $value) {
                $subGroups[$value['id']] = ["ar" => $value['name_ar'], "en" => $value['name_en']];
            }

            session()->put('_old_input.subGroupsWithItsFamilyNames', $subGroupsWithItsFamilyNames);
        }

        $countries = Country::all();
        $subGroups = SubGroup::all();
        return view('dashboard-views.supplier.create', compact('countries', 'subGroups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupplierRequest $request)
    {
        $file['logo'] = null;
        $file['tax_id_number_file'] = null;
        $file['commercial_registeration_number_file'] = null;
        $file['value_add_registeration_number_file'] = null;
        $file['tax_file_number_file'] = null;

        // Start transaction
        DB::beginTransaction();

        try {

            // Start store address
            $address = Address::create([
                "country_id" => $request->country_id,
                "governorate_id" => $request->governorate_id,
                "city_ar" => $request->city_ar,
                "city_en" => $request->city_en,
                "street_ar" => $request->street_ar,
                "street_en" => $request->street_en,
                "building_no" => $request->building_no,
            ]);
            // End store address

            // Start store supplier
            $supplier = Supplier::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'address_id' => $address->id,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'fax' => $request->fax,
                'gmap_url' => $request->gmap_url,
                'website_url' => $request->website_url,
                'person_note' => $request->person_note,
                'family_name_note' => $request->family_name_note,
                'tax_id_number' => $request->tax_id_number,
                'commercial_registeration_number' => $request->commercial_registeration_number,
                'value_add_registeration_number' => $request->value_add_registeration_number,
                'value_add_tax_number' => $request->value_add_tax_number,

                'accredite_note' => $request->accredite_note,
                'cash' => $request->cash,
            ]);
            // End store supplier

            // Start store cheque
            if ($request->cheque) {
                SupplierCheque::create([
                    'name_on_cheque' => $request->name_on_cheque,
                    'supplier_id' => $supplier->id,
                ]);
            }
            // End store cheque

            // Start store bank transfer
            if ($request->bank_transfer) {
                SupplierBankTransfer::create([
                    'bank_account_number' => $request->bank_account_number,
                    'bank_name' => $request->bank_name,
                    'bank_branch' => $request->bank_branch,
                    'supplier_id' => $supplier->id,
                ]);
            }
            // End store bank transfer

            // Start store persons
            foreach ($request->persons as $key => $person) {
                PersonSupplier::create([
                    'name' => $person['name'],
                    'job' => $person['job'],
                    'mobile' => $person['mobile'],
                    'whatsapp' => $person['whatsapp'],
                    'email' => $person['email'],
                    'supplier_id' => $supplier->id,
                ]);
            }
            // End store persons

            // Start store familyNames
            foreach ($request->familyNames as $key => $familyNameId) {
                FamilyNameSupplier::create([
                    'supplier_id' => $supplier->id,
                    'family_name_id' => $familyNameId,
                ]);
            }
            // End store familyNames

            // Start store files
            if ($request->hasFile('logo')) {
                $file['logo'] = $this->storeFile($request->logo, 'uploaded-files/supplier/logo');
            }
            if ($request->hasFile('tax_id_number_file')) {
                $file['tax_id_number_file'] = $this->storeFile($request->tax_id_number_file, 'uploaded-files/supplier/tax_id_number_file');
            }
            if ($request->hasFile('commercial_registeration_number_file')) {
                $file['commercial_registeration_number_file'] = $this->storeFile($request->commercial_registeration_number_file, 'uploaded-files/supplier/commercial_registeration_number_file');
            }
            if ($request->hasFile('value_add_registeration_number_file')) {
                $file['value_add_registeration_number_file'] = $this->storeFile($request->value_add_registeration_number_file, 'uploaded-files/supplier/value_add_registeration_number_file');
            }
            if ($request->hasFile('tax_file_number_file')) {
                $file['tax_file_number_file'] = $this->storeFile($request->tax_file_number_file, 'uploaded-files/supplier/tax_file_number_file');
            }

            $supplier->update([
                'logo' => $file['logo'],
                'tax_id_number_file' => $file['tax_id_number_file'],
                'commercial_registeration_number_file' => $file['commercial_registeration_number_file'],
                'value_add_registeration_number_file' => $file['value_add_registeration_number_file'],
                'tax_file_number_file' => $file['tax_file_number_file'],
            ]);
            // End store files

            DB::commit();
            $this->getSuccessToastrMessage('added_successfully');
            // Notification part (In the future)
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            if ($request->hasFile('logo') &&  $file['logo'] && file_exists(public_path() . "/uploaded-files/supplier/logo/" . $file['logo']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/logo/" . $file['logo']);
            if ($request->hasFile('tax_id_number_file') &&  $file['tax_id_number_file'] && file_exists(public_path() . "/uploaded-files/supplier/tax_id_number_file/" . $file['tax_id_number_file']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/tax_id_number_file/" . $file['tax_id_number_file']);
            if ($request->hasFile('commercial_registeration_number_file') &&  $file['commercial_registeration_number_file'] && file_exists(public_path() . "/uploaded-files/supplier/commercial_registeration_number_file/" . $file['commercial_registeration_number_file']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/commercial_registeration_number_file/" . $file['commercial_registeration_number_file']);
            if ($request->hasFile('value_add_registeration_number_file') &&  $file['value_add_registeration_number_file'] && file_exists(public_path() . "/uploaded-files/supplier/value_add_registeration_number_file/" . $file['value_add_registeration_number_file']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/value_add_registeration_number_file/" . $file['value_add_registeration_number_file']);
            if ($request->hasFile('tax_file_number_file') &&  $file['tax_file_number_file'] && file_exists(public_path() . "/uploaded-files/supplier/tax_file_number_file/" . $file['tax_file_number_file']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/tax_file_number_file/" . $file['tax_file_number_file']);

            $this->getValidationErrorMessage();
            dd($e->getMessage());
        }


        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        // dd($supplier->tax_id_number_file);
        $supplierData['paymentCount'] = 0;
        $supplierData['personSuppliers'] = $supplier->personSuppliers;
        $supplierData['supplierBankTransfer'] = $supplier->supplierBankTransfer ?? null;
        $supplierData['supplierCheque'] = $supplier->supplierCheque ?? null;
        $supplierData['address'] = $supplier->address->getFullAddress();
        $supplierData['familyNamesCount'] = count($supplier->familyNames);

        $supplier->cash ? $supplierData['paymentCount']++ : '';
        $supplierData['supplierBankTransfer'] ? $supplierData['paymentCount']++ : '';
        $supplierData['supplierCheque'] ? $supplierData['paymentCount']++ : '';

        // Get array index is subgroupId, value is array contain related familyNameIds
        $subGroupWithSupplierFamilyNames_id = [];
        foreach ($supplier->familyNames as $key => $supplier_familyName) {
            if (isset($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id])) // if sub-group is founded before and set
                array_push($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id], $supplier_familyName->id);
            else {
                $subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id] = [];
                array_push($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id], $supplier_familyName->id);
            }
        }


        $subGroupWithItsFamilyNames = [];
        foreach (array_keys($subGroupWithSupplierFamilyNames_id) as  $subGroup_id) {
            if (isset($subGroupWithItsFamilyNames[$subGroup_id]))
                array_push($subGroupWithItsFamilyNames[$subGroup_id], SubGroup::find($subGroup_id)->familyNames->toArray());
            else {
                $subGroupWithItsFamilyNames[$subGroup_id] = [];
                array_push($subGroupWithItsFamilyNames[$subGroup_id], SubGroup::find($subGroup_id)->familyNames->toArray());
            }
        }

        $tempSubGroups = SubGroup::select('id', 'name_ar', 'name_en')->whereIn('id', array_keys($subGroupWithSupplierFamilyNames_id))->get()->toArray();
        $subGroups = [];
        foreach ($tempSubGroups as $key => $value) {
            $subGroups[$value['id']] = ["ar" => $value['name_ar'], "en" => $value['name_en']];
        }

        $supplierData['subGroupWithSupplierFamilyNames_id'] = $subGroupWithSupplierFamilyNames_id;
        $supplierData['subGroupWithItsFamilyNames'] = $subGroupWithItsFamilyNames;
        $supplierData['subGroups'] = $subGroups;

        return view('dashboard-views.supplier.show', compact('supplier', 'supplierData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        if (count(session()->getOldInput())) {

            $subGroupWithSupplierFamilyNames_id = [];
            $familyNames = FamilyName::whereIn('id', session()->getOldInput()['familyNames'] ?? [])->get();

            foreach ($familyNames as $key => $supplier_familyName) {
                if (isset($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id])) // if sub-group is founded before and set
                    array_push($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id], $supplier_familyName->id);
                else {
                    $subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id] = [];
                    array_push($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id], $supplier_familyName->id);
                }
            }


            $subGroupsWithItsFamilyNames = [];

            foreach (array_keys($subGroupWithSupplierFamilyNames_id) as  $subGroup_id) {
                $subGroupsWithItsFamilyNames[$subGroup_id]['familyNames'] =  SubGroup::find($subGroup_id)->familyNames->toArray();
                $subGroupsWithItsFamilyNames[$subGroup_id]["selectedFamilyNames"] = $subGroupWithSupplierFamilyNames_id[$subGroup_id];
            }

            $tempSubGroups = SubGroup::select('id', 'name_ar', 'name_en')->whereIn('id', array_keys($subGroupWithSupplierFamilyNames_id))->get()->toArray();
            $subGroups = [];
            foreach ($tempSubGroups as $key => $value) {
                $subGroups[$value['id']] = ["ar" => $value['name_ar'], "en" => $value['name_en']];
            }

            session()->put('_old_input.subGroupsWithItsFamilyNames', $subGroupsWithItsFamilyNames);
        }


        $supplier_familyNames = $supplier->familyNames;

        // Merge all family that have the same subGroup
        $subGroupWithSupplierFamilyNames_id = [];
        foreach ($supplier_familyNames as $key => $supplier_familyName) {
            if (isset($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id]))
                array_push($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id], $supplier_familyName->id);
            else {
                $subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id] = [];
                array_push($subGroupWithSupplierFamilyNames_id[$supplier_familyName->subGroup->id], $supplier_familyName->id);
            }
        }

        $subGroupWithItsFamilyNames = [];
        foreach (array_keys($subGroupWithSupplierFamilyNames_id) as  $subGroup_id) {
            if (isset($subGroupWithItsFamilyNames[$subGroup_id]))
                array_push($subGroupWithItsFamilyNames[$subGroup_id], SubGroup::find($subGroup_id)->familyNames->toArray());
            else {
                $subGroupWithItsFamilyNames[$subGroup_id] = [];
                array_push($subGroupWithItsFamilyNames[$subGroup_id], SubGroup::find($subGroup_id)->familyNames->toArray());
            }
        }

        $countries = Country::all();
        $governorates = Governorate::where('country_id', $supplier->address()->select('country_id')->first()->country_id)->get();
        $subGroups = SubGroup::all();
        $Supplier_bank_transfer = $supplier->supplierBankTransfer ?? null;
        $Supplier_cheque = $supplier->supplierCheque ?? null;
        $responsibePersons = $supplier->personSuppliers;
        return view('dashboard-views.supplier.edit',compact('countries','Supplier_bank_transfer','Supplier_cheque','subGroupWithSupplierFamilyNames_id', 'subGroupWithItsFamilyNames','responsibePersons','governorates','subGroups','supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        // Start transaction
        DB::beginTransaction();

        try {
            $file = [];
            $file['logo'] = $supplier->logo;
            $file['tax_id_number_file'] = $supplier->tax_id_number_file;
            $file['commercial_registeration_number_file'] = $supplier->commercial_registeration_number_file;
            $file['value_add_registeration_number_file'] = $supplier->value_add_registeration_number_file;
            $file['tax_file_number_file'] = $supplier->tax_file_number_file;

            // Start update address
            $supplier->address->update([
                "country_id" => $request->country_id,
                "governorate_id" => $request->governorate_id,
                "city_ar" => $request->city_ar,
                "city_en" => $request->street_ar,
                "street_ar" => $request->street_ar,
                "street_en" => $request->street_en,
                "building_no" => $request->building_no,
            ]);
            // End update address

            // Start update supplier
            $supplier->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
               'address_id' => $supplier->address->id,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'fax' => $request->fax,
                'gmap_url' => $request->gmap_url,
                'website_url' => $request->website_url,
                'person_note' => $request->person_note,
                'family_name_note' => $request->family_name_note,
                'tax_id_number' => $request->tax_id_number,
                'commercial_registeration_number' => $request->commercial_registeration_number,
                'value_add_registeration_number' => $request->value_add_registeration_number,
                'value_add_tax_number' => $request->value_add_tax_number,

                'accredite_note' => $request->accredite_note,
                'cash' => $request->cash,
            ]);
            // End update supplier

            // Start update cheque
            if ($request->cheque) {
                if($supplier->supplierCheque)
                    $supplier->supplierCheque->update([
                        'name_on_cheque' => $request->name_on_cheque
                    ]);
                else
                    SupplierCheque::create([
                        'name_on_cheque' => $request->name_on_cheque,
                        'supplier_id' => $supplier->id,
                    ]);

            } else {
                $supplier->supplierCheque ? $supplier->supplierCheque->delete() : '';
            }
            // End update cheque

            // Start update bank transfer
            if ($request->bank_transfer) {
                if($supplier->supplierBankTransfer)
                    $supplier->supplierBankTransfer->update([
                        'bank_account_number' => $request->bank_account_number,
                        'bank_name' => $request->bank_name,
                        'bank_branch' => $request->bank_branch,
                    ]);
                else
                    SupplierBankTransfer::create([
                        'bank_account_number' => $request->bank_account_number,
                        'bank_name' => $request->bank_name,
                        'bank_branch' => $request->bank_branch,
                        'supplier_id' => $supplier->id,
                    ]);
            } else {
                $supplier->supplierBankTransfer ? $supplier->supplierBankTransfer->delete() : '';
            }
            // End update bank transfer

            // Start update person

            $retrivedPersonsSupplier = [];
            foreach ($request->persons as $person) {
                array_push($retrivedPersonsSupplier, $person['id']);
            }
            $PersonsSupplier = PersonSupplier::where('supplier_id', $supplier->id)->pluck('id')->toArray();

            $deletedPersonSupplier = array_diff($PersonsSupplier, $retrivedPersonsSupplier);
            PersonSupplier::whereIn('id', $deletedPersonSupplier)->delete();

            unset($deletedPersonSupplier, $PersonsSupplier, $retrivedPersonsSupplier);

            foreach ($request->persons as $person) {
                if($person['id'])
                    PersonSupplier::where('id', $person['id'])->update([
                        'name' => $person['name'],
                        'job' => $person['job'],
                        'mobile' => $person['mobile'],
                        'whatsapp' => $person['whatsapp'],
                        'email' => $person['email'],
                        ]);
                else
                    PersonSupplier::create([
                    'name' => $person['name'],
                    'job' => $person['job'],
                    'mobile' => $person['mobile'],
                    'whatsapp' => $person['whatsapp'],
                    'email' => $person['email'],
                    'supplier_id' => $supplier->id,
                    ]);
            }
            // End update person

            // Start update family names
            $retrivedFamilyNames = $request->familyNames;
            $familyNamesSupplierFamilyNameIds = [];
            $deletedFamilyNamesSupplier = [];
            $currentFamilyNamesSupplier = [];

            $familyNamesSupplier = FamilyNameSupplier::where('supplier_id', $supplier->id)->pluck('family_name_id', 'id')->toArray();

            foreach ($familyNamesSupplier as $familyNamesSupplierId => $familyNamesSupplierFamilyNameId) {
                array_push($familyNamesSupplierFamilyNameIds, $familyNamesSupplierFamilyNameId);
                if(!in_array($familyNamesSupplierFamilyNameId, $retrivedFamilyNames)) {
                    array_push($deletedFamilyNamesSupplier, $familyNamesSupplierId);
                    unset($familyNamesSupplier[$familyNamesSupplierId]);
                } else {
                    array_push($currentFamilyNamesSupplier, $familyNamesSupplierFamilyNameId);
                }
            }

            FamilyNameSupplier::whereIn('id', $deletedFamilyNamesSupplier)->delete();
            $addedFamilyNameIdsSupplier = array_diff($retrivedFamilyNames, $currentFamilyNamesSupplier);

            foreach ($addedFamilyNameIdsSupplier as $addedFamilyNameIdSupplier) {
                FamilyNameSupplier::create([
                    'supplier_id' => $supplier->id,
                    'family_name_id' => $addedFamilyNameIdSupplier,
                ]);
            }

            unset($retrivedFamilyNames, $familyNamesSupplierFamilyNameIds, $deletedFamilyNamesSupplier, $currentFamilyNamesSupplier, $familyNamesSupplier);
            // End update family names

            // Start update files
            if ($request->hasFile('logo')) {
                $file['logo'] = $this->storeFile($request->logo, 'uploaded-files/supplier/logo', public_path() . "/uploaded-files/supplier/logo/".$supplier->logo);
            }
            if ($request->hasFile('tax_id_number_file')) {
                $file['tax_id_number_file'] = $this->storeFile($request->tax_id_number_file, 'uploaded-files/supplier/tax_id_number_file',public_path() .'/uploaded-files/supplier/tax_id_number_file/'.$supplier->tax_id_number_file );
            }
            if ($request->hasFile('commercial_registeration_number_file')) {
                $file['commercial_registeration_number_file'] = $this->storeFile($request->commercial_registeration_number_file, 'uploaded-files/supplier/commercial_registeration_number_file',public_path() .'/uploaded-files/supplier/commercial_registeration_number_file/'.$supplier->commercial_registeration_number_file );
            }
            if ($request->hasFile('value_add_registeration_number_file')) {
                $file['value_add_registeration_number_file'] = $this->storeFile($request->value_add_registeration_number_file, 'uploaded-files/supplier/value_add_registeration_number_file',public_path() .'/uploaded-files/supplier/value_add_registeration_number_file/'.$supplier->value_add_registeration_number_file );
            }
            if ($request->hasFile('tax_file_number_file')) {
                $file['tax_file_number_file'] = $this->storeFile($request->tax_file_number_file, 'uploaded-files/supplier/tax_file_number_file',public_path() .'/uploaded-files/supplier/tax_file_number_file/'.$supplier->tax_file_number_file );
            }

            $supplier->update([
                'logo' => $file['logo'],
                'tax_id_number_file' => $file['tax_id_number_file'],
                'commercial_registeration_number_file' => $file['commercial_registeration_number_file'],
                'value_add_registeration_number_file' => $file['value_add_registeration_number_file'],
                'tax_file_number_file' => $file['tax_file_number_file'],
            ]);
            // End update files

            DB::commit();
            $this->getSuccessToastrMessage('updated_successfully');
            // Notification part (In the future)
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            if ($request->hasFile('logo') &&  $file['logo'] && file_exists(public_path() . "/uploaded-files/supplier/logo/" . $file['logo']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/logo/" . $file['logo']);
            if ($request->hasFile('tax_id_number_file') &&  $file['tax_id_number_file'] && file_exists(public_path() . "/uploaded-files/supplier/tax_id_number_file/" . $file['tax_id_number_file']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/tax_id_number_file/" . $file['tax_id_number_file']);
            if ($request->hasFile('commercial_registeration_number_file') &&  $file['commercial_registeration_number_file'] && file_exists(public_path() . "/uploaded-files/supplier/commercial_registeration_number_file/" . $file['commercial_registeration_number_file']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/commercial_registeration_number_file/" . $file['commercial_registeration_number_file']);
            if ($request->hasFile('value_add_registeration_number_file') &&  $file['value_add_registeration_number_file'] && file_exists(public_path() . "/uploaded-files/supplier/value_add_registeration_number_file/" . $file['value_add_registeration_number_file']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/value_add_registeration_number_file/" . $file['value_add_registeration_number_file']);
            if ($request->hasFile('tax_file_number_file') &&  $file['tax_file_number_file'] && file_exists(public_path() . "/uploaded-files/supplier/tax_file_number_file/" . $file['tax_file_number_file']))
                $this->deleteStoredFile(public_path() . "/uploaded-files/supplier/tax_file_number_file/" . $file['tax_file_number_file']);

            $this->getValidationErrorMessage();

        }

        return redirect()->route('supplier.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */

    public function trash(Request $request)
    {
        $supplier = Supplier::findOrFail($request->supplier_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $supplier->Delete();
        } catch (\Illuminate\Database\QueryException $e) { // Handle integrity constraint violation
            $availableToDelete = false;
            if ($e->errorInfo[0] == 23000) {
                // $errorMessage = '';
                $errorMessage = $e->getMessage();
            } else {
                $errorMessage = 'DB error';
            }
        } finally {
            DB::rollBack();
        }

        // End check if record can be deleted
        $supplier = Supplier::findOrFail($request->supplier_id);
        if ($availableToDelete) {
            $status = true;
            $supplier->delete();
            
        } else {
            $status = false;
        }

        return json_encode([
            'status' => $status,
            'errorMessage' => $errorMessage,
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        $supplier = Supplier::withTrashed()->where('id', $request->supplier_id)->firstOrFail();
        $status = null;

        if ($supplier->trashed()) {
            $supplier->restore();

            // Notification part (In the future)

            $status = true;
        } else {
            $status = false;
        }
        return json_encode([
            'status' => $status,
            'errorMessage' => 'already founded',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permanent_delete(Request $request)
    {
        // Start transaction
        DB::beginTransaction();
        try {

            $supplier = Supplier::onlyTrashed()->findOrFail($request->supplier_id);

            $deletedsupplier = clone $supplier; // used in notifications

            $supplier->forceDelete();

            $errorMessage = '';
            $status = null;

            // Notification part (In the future)

            $status = true;

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) { // Handle integrity constraint violation
            DB::rollBack();

            if ($e->errorInfo[0] == 23000) {
                // $errorMessage = '';
                $errorMessage = $e->getMessage();
            } else {
                $errorMessage = 'DB error';
            }

            $status = false;
        }
        return json_encode([
            'status' => $status,
            'errorMessage' => $errorMessage,
        ]);
    }

    public function supplier_search(Request $request)
    {
        $temp_supplier = collect([
            "id" => '',
            "name_ar" => '',
            "name_en" => '',
            "address" => '',
            "trashed" => '',
            "created_at" => '',
        ]);
        $suppliers = collect();

        $searchContentAr = $request->search_content_ar;
        if ($searchContentAr)
            $searchContentArParts = array_values(array_unique(explode(" ", $searchContentAr)));
        else
            $searchContentArParts = [];

        $searchContentEn = $request->search_content_en;

        if ($searchContentEn)
            $searchContentEnParts = array_values(array_unique(explode(" ", $searchContentEn)));
        else
            $searchContentEnParts = [];

        $length = count($searchContentArParts);

        for ($i = 0; $i < $length; $i++) {
            $data = Supplier::where('name_ar', 'like', '%' . $searchContentArParts[$i] . '%')->withTrashed()->with('address')->get();
            for ($j = 0; $j < count($data); $j++) {
                $suppliers->push($data[$j]);
            }
        }

        $length = count($searchContentEnParts);

        for ($i = 0; $i < $length; $i++) {
            $data = Supplier::where('name_en', 'like', '%' . $searchContentEnParts[$i] . '%')->withTrashed()->with('address')->get();
            for ($j = 0; $j < count($data); $j++) {
                $suppliers->push($data[$j]);
            }
        }

        $uniqueSuppliers = $suppliers->unique();
        $suppliers = [];
        foreach ($uniqueSuppliers as $uniqueSupplier) {
            $temp_supplier['id'] = $uniqueSupplier->id;
            $temp_supplier['name_ar'] = $uniqueSupplier->name_ar;
            $temp_supplier['name_en'] = $uniqueSupplier->name_en;
            $temp_supplier['created_at'] = $uniqueSupplier->created_at;
            $temp_supplier['trashed'] = $uniqueSupplier->deleted_at ? true : false;
            $temp_supplier['address'] = $uniqueSupplier->address->getFullAddress();

            array_push($suppliers, clone $temp_supplier);
        }

        $returnHTML = view('dashboard-views.supplier.supplier_search', compact('suppliers'))->render();

        return response()->json(array('length' => count($suppliers), 'html' => $returnHTML));


        // return view('dashboard-views.supplier.supplier_search', compact('suppliers'))->render();
    }
}
