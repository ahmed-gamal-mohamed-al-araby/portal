@php
$currentLanguage = app()->getLocale();
$currentIndex = $departments->firstItem();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.Name')</th>
            <th> @lang('site.Sector')</th>
            <th> @lang('site.Manager')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>
        @foreach ($departments as $department)
            <tr>
                <td>{{ $currentIndex++ }}</td>
                <td>{{ $department['name_' . $currentLanguage] }}</td>
                <td>{{ $department->sector['name_' . $currentLanguage] }}</td>
                <td>{{ $department->manager['name_' . $currentLanguage] }}</td>
                <td>
                    <div class="service-option">
                        @if ($pageType == 'index')
                            <a href="{{ route('department.show', ['department' => $department->id]) }}"
                                class="btn btn-success"><i class="fa fa-eye"></i> @lang('site.Show')</a>
                            <a class=" btn btn-warning my-1 mx-0"
                                href="{{ route('department.edit', $department->id) }}"><i class="fa fa-edit"></i>
                                @lang('site.Edit') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-department_id="{{ $department->id }}"
                                data-type='delete' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Delete') </a>
                        @elseif($pageType == 'trashed')
                            <a class=" btn btn-success my-1 mx-0" data-department_id="{{ $department->id }}"
                                data-type='restore' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fas fa-trash-restore-alt"></i>
                                @lang('site.Restore') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-department_id="{{ $department->id }}"
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
            {{ $departments->currentPage() }} @lang('site.From') {{ $departments->lastPage() }}
            {{-- Handle plural or singular for page word --}}
            @if ($departments->lastPage() > 1)
                @lang('site.Pages')
            @else
                @lang('site.Page')
            @endif
        </div>
    </div>
    <div class="">
        {!! $departments->links() !!}
    </div>
</div>
