@extends('layouts.mob.master')

@section('title')
    @lang('translation.TaskDetails')
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            @lang('translation.Task')
        @endslot
        @slot('title')
            @lang('translation.TaskDetails')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-4">
                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                    {{ $task->task_status }}
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-truncate font-size-15">#{{ $task->id }} Task Name</h5>
                            <p class="text-muted">{{ $task->task_name }}</p>
                        </div>
                    </div>
                    <h5 class="font-size-15 mt-4">Task Description:</h5>
                    <p class="text-muted">{{ $task->remarks }}</p>
                    <div class="text-muted mt-4">
                        <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Created By: {{ $task->created_by }}</p>
                        <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Created At: {{ $task->created_at }}</p>
                        <p><i class="mdi mdi-chevron-right text-primary me-1"></i> Updated At: {{ $task->updated_at }}</p>
                    </div>
                    <div class="row task-dates">
                        <div class="col-sm-4 col-6">
                            <div class="mt-4">
                                <h5 class="font-size-14"><i class="bx bx-calendar me-1 text-primary"></i> Start Date</h5>
                                <p class="text-muted mb-0">{{ $task->start_time }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="mt-4">
                                <h5 class="font-size-14"><i class="bx bx-calendar-check me-1 text-primary"></i> End Date
                                </h5>
                                <p class="text-muted mb-0">{{ $task->end_time }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Assignee</h4>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <tbody>
                                @if (isset($task->users) && count($task->users) > 0)
                                    @foreach ($task->users as $user)
                                        <tr>
                                            <td style="width: 50px;"><img src="{{ asset($user->avatar) }}"
                                                    class="rounded-circle avatar-xs" alt=""></td>
                                            <td>
                                                <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-dark">{{ $user->name }}</a></h5>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);"
                                                        class="badge bg-primary bg-soft text-primary font-size-11">{{ $user->role }}</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (isset($status))
                        @if (isset($status) && $status === 1)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bx bx-check-circle"></i>
                                {{ $msg }} #ID {{ $shop_id }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @else
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bx bx-error-alt"></i>
                                {{ $msg }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    @endif
                    <div class="accordion" id="add-task-route">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Add Route
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#add-task-route">
                                <div class="accordion-body">
                                    <!-- end accordion -->
                                    <h4 class="card-title">Task Route</h4>
                                    <p class="card-title-desc">Fill all information below</p>
                                    <form id="form-task-route" method="post" action="{{ url('/mob/task/route/add') }}">
                                        {{ csrf_field() }}
                                        <input id="task_id" name="task_id" type="hidden" value={{ $task->id }}>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="sequence">Task Sequence</label>
                                                    <input id="sequence" name="sequence" type="number"
                                                        class="form-control" placeholder="Task Sequence">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="shop_id">Shop Name</label>
                                                    <select id="shop_id" name="shop_id" class="form-control select2">
                                                        <option>Select</option>
                                                        @if (isset($customers) && count($customers) > 0)
                                                            @foreach ($customers as $cust)
                                                                <option value="{{ $cust->id }}">
                                                                    {{ $cust->shop_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="control-label">Task Status</label>
                                                    <select id="task_status" name="task_status"
                                                        class="form-control select2">
                                                        <option>Select</option>
                                                        @if (isset($task_status) && count($task_status) > 0)
                                                            @foreach ($task_status as $status)
                                                                <option value="{{ $status->lov_code }}">
                                                                    {{ $status->lov_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="start_time">Start Time</label>
                                                    <input name="start_time" class="form-control" type="datetime-local"
                                                        placeholder="Start Time" id="start_time">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="end_time">End Time</label>
                                                    <input name="end_time" class="form-control" type="datetime-local"
                                                        placeholder="End Time" id="end_time">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="remarks">Remarks</label>
                                                    <textarea class="form-control" name="remarks" id="remarks" rows="5" placeholder="Remarks"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <button type="submit" id="save-task-route"
                                                                class="btn btn-primary waves-effect waves-light">Add
                                                                Route</button>
                                                            <button type="reset" id="reset-task-route"
                                                                class="btn btn-secondary waves-effect waves-light">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Task Sequence</h4>
                    @if (isset($all_routes))
                        @foreach ($all_routes as $route)
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-4">
                                                <div class="avatar-md">
                                                    <span
                                                        class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                        @if (isset($route->customer))
                                                            <img src="{{ asset($route->customer->shop_image) }}"
                                                                alt="" height="30">
                                                        @else
                                                            {{ $route->sequence }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                        class="text-dark">Route#{{ $route->sequence }}
                                                        {{ $route->customer->shop_name }}</a></h5>
                                                <p class="text-muted mb-4">Owner: {{ $route->customer->owner }}</p>
                                                <div class="avatar-group">
                                                    Note: {{ $route->remarks }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 border-top">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-3">
                                                <span class="badge bg-success">{{ $route->status }}</span>
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <i class="bx bx-calendar me-1"></i> {{ $route->created_at }}
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <form method="post"
                                                    action="{{ url('mob/task/route/delete') }}/{{ $route->id }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" name="delroute"
                                                        class="btn action-icon text-danger" title="Delete"><i
                                                            class="mdi mdi-trash-can"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
@section('script')
@endsection
