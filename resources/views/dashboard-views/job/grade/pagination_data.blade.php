@php
$currentLanguage = app()->getLocale();
$currentIndex = $jobGrades->firstItem();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.Job_grade')</th>
            <th> @lang('site.Job_code')</th>
            <th> @lang('site.Department')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>
        @foreach ($jobGrades as $jobGrade)
            <tr>
                <td>{{ $currentIndex++ }}</td>
                <td>{{ $jobGrade->grade }}</td>
                <td>{{ $jobGrade->jobCode->code }}</td>
                <td>{{ $jobGrade->jobCode->department['name_' . $currentLanguage] }}</td>
                <td>
                    <div class="service-option">
                        @if ($pageType == 'index')
                            <a class=" btn btn-warning my-1 mx-0"
                                href="{{ route('job-grade.edit', $jobGrade->id) }}"><i class="fa fa-edit"></i>
                                @lang('site.Edit') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-job_grade_id="{{ $jobGrade->id }}"
                                data-type='delete' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Delete') </a>
                        @elseif($pageType == 'trashed')
                            <a class=" btn btn-success my-1 mx-0" data-job_grade_id="{{ $jobGrade->id }}"
                                data-type='restore' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fas fa-trash-restore-alt"></i>
                                @lang('site.Restore') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-job_grade_id="{{ $jobGrade->id }}"
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
            {{ $jobGrades->currentPage() }} @lang('site.From') {{ $jobGrades->lastPage() }}
            {{-- Handle plural or singular for page word --}}
            @if ($jobGrades->lastPage() > 1)
                @lang('site.Pages')
            @else
                @lang('site.Page')
            @endif
        </div>
    </div>
    <div>
        {!! $jobGrades->links() !!}
    </div>
</div>
