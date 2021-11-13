@php
$currentLanguage = app()->getLocale();
$currentIndex = $approvalTimelines->firstItem();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

{{-- Table Header --}}
<thead>
    <tr>
        <th> @lang('site.Id')</th>
        <th> @lang('site.table_name')</th>
        <th>@lang('site.project')</th>
        <th>@lang('site.site')</th>
        <th> @lang('site.actions')</th>
    </tr>
</thead>

{{-- Table body --}}
<tbody>
    @foreach ($approvalTimelines as $index => $approvalTimeline)
        <tr>
        <td>{{ $currentIndex++ }}</td>
            <td>@lang('site.' . $approvalTimeline->table_name)</td>
            <td>
                @if(count($projects[$index]))
                    {{$projects[$index][0]['name_' . $currentLanguage] }}
                @else 
                    @lang("site.not_available")
                @endif
            </td>
            <td>
            @if(count($sites[$index]))
                {{$sites[$index][0]['name_' . $currentLanguage] }}
            @else
                @lang("site.not_available")
            @endif
            </td>
            <td>
                <div class="service-option">
                    <a href="{{ route('approvals.timeline_by_id', $approvalTimeline->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> @lang('site.Show') </a>
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
            {{ $approvalTimelines->currentPage() }} @lang('site.From') {{ $approvalTimelines->lastPage() }}
            {{-- Handle plural or singular for page word --}}
            @if ($approvalTimelines->lastPage() > 1)
                @lang('site.Pages')
            @else
                @lang('site.Page')
            @endif
        </div>
    </div>
    <div class="">
        {!! $approvalTimelines->links() !!}
    </div>
</div>
