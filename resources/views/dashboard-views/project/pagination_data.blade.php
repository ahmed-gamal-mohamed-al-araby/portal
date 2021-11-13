@php
$currentLanguage = app()->getLocale();
$currentIndex = $projects->firstItem();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.Name')</th>
            <th> @lang('site.Sites')</th>
            <th> @lang('site.Sector')</th>
            <th> @lang('site.the_manager')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <td>{{ $currentIndex++ }}</td>
                <td>{{ $project['name_' . $currentLanguage] }}</td>
                <td>
                    @forelse ($project->sites as $site)
                        <span class="type_service">{{ $site['name_' . $currentLanguage] }} </span>
                    @empty
                        <span class="type_service bg-danger">
                            @lang('site.not_available')</span>
                    @endforelse
                </td>
                <td>{{ $project->sector['name_' . $currentLanguage] }}</td>
                <td>{{ $project->manager['name_' . $currentLanguage] }}</td>
                <td>
                    <div class="service-option">
                        @if ($pageType == 'index' || $pageType == 'completed')
                            <a href="{{ route('project.show', ['project' => $project->id]) }}"
                                class="btn btn-success"><i class="fa fa-eye"></i> @lang('site.Show')</a>
                            <a class=" btn btn-warning my-1 mx-0" href="{{ route('project.edit', $project->id) }}"><i
                                    class="fa fa-edit"></i>
                                @lang('site.Edit') </a>
                            @if ($pageType == 'index')
                                <a class=" btn btn-danger my-1 mx-0" data-project_id="{{ $project->id }}"
                                    data-type='delete' data-toggle="modal" data-target="#confirm_modal"><i
                                        class="fa fa-trash-alt"></i>
                                    @lang('site.Delete') </a>
                            @endif
                        @elseif($pageType == 'trashed')
                            <a class=" btn btn-success my-1 mx-0" data-project_id="{{ $project->id }}"
                                data-type='restore' data-toggle="modal" data-target="#confirm_modal"><i
                                    class="fas fa-trash-restore-alt"></i>
                                @lang('site.Restore') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-project_id="{{ $project->id }}"
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
        <div class=" dataTables_info" id="datatableTemplate_info" role="status" aria-live="polite">
        @lang('site.Show')
        {{ $projects->currentPage() }} @lang('site.From') {{ $projects->lastPage() }}
        {{-- Handle plural or singular for page word --}}
        @if ($projects->lastPage() > 1)
            @lang('site.Pages')
        @else
            @lang('site.Page')
        @endif
    </div>
</div>
<div class="">
    {!! $projects->links() !!}
</div>
</div>
