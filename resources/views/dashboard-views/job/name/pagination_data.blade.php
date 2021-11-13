@php
$currentLanguage = app()->getLocale();
$currentIndex = $jobNames->firstItem();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.Job_name')</th>
            <th> @lang('site.Job_code')</th>
            <th> @lang('site.Department')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>
        @foreach ($jobNames as $jobName)
            <tr>
                <td>{{ $currentIndex++ }}</td>
                <td>{{ $jobName['name_' . $currentLanguage] }}</td>
                <td>{{ $jobName->jobCode->code }}</td>
                <td>{{ $jobName->jobCode->department['name_' . $currentLanguage] }}</td>
                <td>
                    <div class="service-option">
                        @if ($pageType == 'index')
                            <a class=" btn btn-warning my-1 mx-0"
                                href="{{ route('job-name.edit', $jobName->id) }}"><i class="fa fa-edit"></i>
                                @lang('site.Edit') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-job_name_id="{{ $jobName->id }}"
                                data-type='delete' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Delete') </a>
                        @elseif($pageType == 'trashed')
                            <a class=" btn btn-success my-1 mx-0" data-job_name_id="{{ $jobName->id }}"
                                data-type='restore' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fas fa-trash-restore-alt"></i>
                                @lang('site.Restore') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-job_name_id="{{ $jobName->id }}"
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
    <div>
        <div class="dataTables_info" id="datatableTemplate_info" role="status" aria-live="polite">@lang('site.Show')
            {{ $jobNames->currentPage() }} @lang('site.From') {{ $jobNames->lastPage() }}
            {{-- Handle plural or singular for page word --}}
            @if ($jobNames->lastPage() > 1)
                @lang('site.Pages')
            @else
                @lang('site.Page')
            @endif
        </div>
    </div>
    <div>
        {!! $jobNames->links() !!}
    </div>
</div>
