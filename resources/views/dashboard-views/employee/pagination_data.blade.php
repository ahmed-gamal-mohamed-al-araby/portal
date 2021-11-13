@php
$currentLanguage = app()->getLocale();
$currentIndex = $users->firstItem();
@endphp

<table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

    {{-- Table Header --}}
    <thead>
        <tr>
            <th> @lang('site.Id')</th>
            <th> @lang('site.Name')</th>
            <th> @lang('site.Username')</th>
            <th> @lang('site.Job_code')</th>
            <th> @lang('site.the_manager')</th>
            <th> @lang('site.Sector')</th>
            <th> @lang('site.Department')</th>
            <th> @lang('site.Project')</th>
            <th> @lang('site.actions')</th>
        </tr>
    </thead>

    {{-- Table body --}}
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $currentIndex++ }}</td>
                <td>{{ $user['name_' . $currentLanguage] }} @if ($user->board_member)<i class="fas fa-star" style="  color: #EEBD01;"></i>@endif</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->code }}</td>
                <td>{{ $user->manager ? $user->manager['name_' . $currentLanguage] : '_' }}</td>
                <td>{{ $user->sector ? $user->sector['name_' . $currentLanguage]  : '_'}} </td>
                <td>{{ $user->department ? $user->department['name_' . $currentLanguage] : '_' }}</td>
                <td>{{ $user->project ? $user->project['name_' . $currentLanguage] : '_' }}</td>
                <td>
                    <div class="service-option">
                        <a href="{{ route('employee.show', ['employee' => $user->id]) }}"
                            class="btn btn-success"><i class="fa fa-eye"></i> @lang('site.Show')</a>
                        @if ($pageType == 'index')
                            <a class=" btn btn-warning my-1 mx-0"
                                href="{{ route('employee.edit', $user->id) }}"><i class="fa fa-edit"></i>
                                @lang('site.Edit') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-user_id="{{ $user->id }}"
                                data-type='deactive' data-toggle="modal" data-target="#confirm_modal{{$user->id}}"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Delete') </a>
                        @elseif($pageType == 'trashed')
                            <a class=" btn btn-success my-1 mx-0" data-user_id="{{ $user->id }}"
                                data-type='restore' data-toggle="modal" data-target="#confirm_modal_restore{{$user->id}}"><i
                                    class="fas fa-trash-restore-alt"></i>
                                @lang('site.Restore') </a>
                            <a class=" btn btn-danger my-1 mx-0" data-user_id="{{ $user->id }}"
                                data-type='permanent_delete' data-toggle="modal" data-target="#confirm_modal_all{{$user->id}}"><i
                                    class="fa fa-trash-alt"></i>
                                @lang('site.Permanent_delete') </a>
                                {{-- Confirm modal --}}
                            
                        @endif
                        <div class="modal fade text-center" id="confirm_modal{{$user->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-title">
                                            @lang('site.Deactive_employee')
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                           
                                        </div>
                                        <div class="modal-body" id="modal-body">
                                            <p>
                                     @lang('site.confirm') @lang('site.deactive_employee') {{ $currentLanguage == 'ar' ? '؟' : '?' }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.No') ,
                                                @lang('site.Cancel')</button>

                                            {{-- Form to deactive user --}}
                                            <a href="{{route('employee.deactive.trash',$user->id)}}" class="btn btn-outline-dark"> @lang('site.Yes') , @lang('site.delete') <span
                                                        id="action-btn-text"></span>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                
                    <!-- Delete All --> 
                    <div class="modal fade text-center" id="confirm_modal_all{{$user->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-title">
                                            @lang('site.Delete') @lang('site.the_employee')
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                           
                                        </div>
                                        <div class="modal-body" id="modal-body">
                                            <p>
                                            @lang('site.confirm') @lang('site.Delete') @lang('site.the_employee') {{ $currentLanguage == 'ar' ? '؟' : '?' }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.No') ,
                                                @lang('site.Cancel')</button>

                                            {{-- Form to Delete user --}}
                                            <a href="{{route('employee.deactive.all',$user->id)}}" class="btn btn-outline-dark"> @lang('site.Yes') , @lang('site.delete') <span
                                                        id="action-btn-text"></span>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <!-- restore --> 
                    <div class="modal fade text-center" id="confirm_modal_restore{{$user->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-title">
                                            @lang('site.Restore') @lang('site.the_employee')
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                           
                                        </div>
                                        <div class="modal-body" id="modal-body">
                                            <p>
                                            @lang('site.confirm') @lang('site.Restore') @lang('site.the_employee') {{ $currentLanguage == 'ar' ? '؟' : '?' }}
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.No') ,
                                                @lang('site.Cancel')</button>

                                            {{-- Form to restore user --}}
                                            <a href="{{route('employee.restore.employee',$user->id)}}" class="btn btn-outline-dark"> @lang('site.Yes') , @lang('site.restore') <span
                                                        id="action-btn-text"></span>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            {{ $users->currentPage() }} @lang('site.From') {{ $users->lastPage() }}
            {{-- Handle plural or singular for page word --}}
            @if ($users->lastPage() > 1)
                @lang('site.Pages')
            @else
                @lang('site.Page')
            @endif
        </div>
    </div>
    <div class="">
        {!! $users->links() !!}
    </div>
</div>
