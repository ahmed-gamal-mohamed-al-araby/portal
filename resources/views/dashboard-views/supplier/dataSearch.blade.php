@php
$currentLanguage = app()->getLocale();

@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.Name')</th>
            <th> @lang('site.Phone')</th>
            <th> @lang('site.Address')</th>
            <th> @lang('site.tax_id_number_only')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
        <tbody>
            @foreach ($suppliers as $index => $supplier)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $supplier['name_' . $currentLanguage] }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->address->getFullAddress()[$currentLanguage] }}</td>
                    <td>{{ $supplier->tax_id_number }}</td>
                    <td>
                        <div class="service-option">
                            @if ($pageType == 'index')
                                <a href="{{ route('supplier.show', ['supplier' => $supplier->id]) }}" class="btn btn-success"><i
                                        class="fa fa-eye"></i> @lang('site.Show')</a>
                                <a class=" btn btn-warning my-1 mx-0"
                                    href="{{ route('supplier.edit', $supplier->id) }}"><i class="fa fa-edit"></i>
                                    @lang('site.Edit') </a>
                                <a class=" btn btn-danger my-1 mx-0" data-supplier_id="{{ $supplier->id }}"
                                    data-type='delete' data-toggle="modal" data-target="#confirm_modal"><i
                                        class="fa fa-trash-alt"></i>
                                    @lang('site.Delete') </a>
                            @endif
            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>

</table>