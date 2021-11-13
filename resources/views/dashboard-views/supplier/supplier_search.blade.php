@php
$currentLanguage = app()->getLocale();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.arabic_name')</th>
            <th> @lang('site.english_name')</th>
            <th> @lang('site.Address')</th>
            <th> @lang('site.Create_at')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>
        @foreach ($suppliers as $supplier)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $supplier['name_ar'] }}</td>
                <td>{{ $supplier['name_en'] }}</td>
                <td>{{ $supplier['address'][$currentLanguage] }}</td>
                {{-- <td>{{ $supplier->created_at }}</td> --}}
                <td>{{ '1-1-2021' }}</td>
                <td>
                    <div class="service-option">
                        @if ($supplier['trashed'])
                            <a class=" btn btn-success my-1 mx-0" data-supplier_id="{{ $supplier['id'] }}"
                                data-type='restore' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fas fa-trash-restore-alt"></i>
                                @lang('site.Restore') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-supplier_id="{{ $supplier['id'] }}"
                                data-type='permanent_delete' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Permanent_delete') </a>
                        @else
                            <a class="btn btn-success my-1 mx-0"
                                href="{{ route('supplier.show', $supplier['id']) }}"><i class="fa fa-eye"></i>
                                @lang('site.Show') </a>
                        @endif

                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
