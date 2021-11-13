@php
$currentLanguage = app()->getLocale();
$currentIndex = $purchaseRequests->firstItem();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.Request_number')</th>
            <th> @lang('site.Date')</th>
            <th> @lang('site.Creator')</th>
            <th> @lang('site.Sector')</th>
            <th> @lang('site.Department')</th>
            <th> @lang('site.Project')</th>
            <th> @lang('site.Site')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>
        @foreach ($purchaseRequests as $purchaseRequest)
            <tr>
                <td>{{ $currentIndex++ }}</td>
                <td>{{ $purchaseRequest['request_number'] }}</td>
                <td>{{ $purchaseRequest['created_at']->format('d-m-Y') }}</td>
                <td>{{ $purchaseRequest->requester['name_' . $currentLanguage] }}</td>
                <td>{{ $purchaseRequest->sector['name_' . $currentLanguage] }}</td>
                <td>{{ $purchaseRequest->department['name_' . $currentLanguage] ?? '' }}</td>
                <td>{{ $purchaseRequest->project['name_' . $currentLanguage] ?? '' }}</td>
                <td>{{ $purchaseRequest->site['name_' . $currentLanguage] ?? '' }}</td>
                <td>
                    <div class="service-option">
                        @if ($pageType == 'index')
                            @if(!$purchaseRequest->sent)
                                <a class=" btn btn-warning my-1 mx-0" href="{{ route('purchase-request.edit', $purchaseRequest->id) }}"><i
                                        class="fa fa-edit"></i>
                                    @lang('site.Edit') </a>
                                <a class=" btn btn-danger my-1 mx-0" data-purchase_request_id="{{ $purchaseRequest->id }}"
                                    data-type='delete' data-toggle="modal" data-target="#confirm_modal"><i
                                        class="fa fa-trash-alt"></i>
                                    @lang('site.Delete') </a>
                            
                                    <a class=" btn btn-success my-1 mx-0" data-purchase_request_id="{{ $purchaseRequest->id }}"
                                        data-type='sendforapprove' data-toggle="modal" data-target="#confirm_modal"><i class="fas fa-paper-plane"></i>
                                        @lang('site.Send') </a>
                            @else
                                    {{ '_' }}
                            @endif
                                
                        @elseif($pageType == 'trashed')
                            <a class=" btn btn-success my-1 mx-0" data-purchase_request_id="{{ $purchaseRequest->id }}"
                                data-type='restore' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fas fa-trash-restore-alt"></i>
                                @lang('site.Restore') </a>
                            {{-- <a class=" btn btn-danger my-1 mx-0" data-purchase_request_id="{{ $purchaseRequest->id }}"
                                data-type='permanent_delete' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Permanent_delete') </a> --}}
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
            {{ $purchaseRequests->currentPage() }} @lang('site.From') {{ $purchaseRequests->lastPage() }}
            {{-- Handle plural or singular for page word --}}
            @if ($purchaseRequests->lastPage() > 1)
                @lang('site.Pages')
            @else
                @lang('site.Page')
            @endif
        </div>
    </div>
    <div class="">
        {!! $purchaseRequests->links() !!}
    </div>
</div>
