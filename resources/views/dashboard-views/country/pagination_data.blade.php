@php
$currentLanguage = app()->getLocale();
$currentIndex = $countries->firstItem();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.Name')</th>
            <th> @lang('site.country_code')</th>
            <th> @lang('site.country_phone_code')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>
        @foreach ($countries as $country)
            <tr>
                <td>{{ $currentIndex++ }}</td>
                <td>{{ $country['name_' . $currentLanguage] }}</td>
                <td>{{ $country->code }}</td>
                <td>{{ $country->phone_code }}</td>
                <td>
                    <div class="service-option">
                        @if ($pageType == 'index')
                            <a class=" btn btn-warning my-1 mx-0" href="{{ route('country.edit', $country->id) }}"><i
                                    class="fa fa-edit"></i>
                                @lang('site.Edit') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-country_id="{{ $country->id }}"
                                data-type='delete' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Delete') </a>
                        @elseif($pageType == 'trashed')
                            <a class=" btn btn-success my-1 mx-0" data-country_id="{{ $country->id }}"
                                data-type='restore' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fas fa-trash-restore-alt"></i>
                                @lang('site.Restore') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-country_id="{{ $country->id }}"
                                data-type='permanent_delete' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Permanent_delete') </a>
                        @endif

                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
<div class="row m-0 justify-content-between panination_container">
    <div class="">
        <div class="dataTables_info" id="datatableTemplate_info" role="status" aria-live="polite">@lang('site.Show')
            {{ $countries->currentPage() }} @lang('site.From') {{ $countries->lastPage() }}
            {{-- Handle plural or singular for page word --}}
            @if ($countries->lastPage() > 1)
                @lang('site.Pages')
            @else
                @lang('site.Page')
            @endif
        </div>
    </div>
    <div class="">
        {!! $countries->links() !!}
    </div>
</div>
