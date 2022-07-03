@extends('layouts.mob.master')

@section('title')
    @lang('translation.TaskRoute')
@endsection

@section('css')
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Task Sequence</h4>
                    @if (isset($task->routes))
                        @foreach ($task->routes as $route)
                            <div id="customer" class="row">
                                <div class="col-xl-4 col-sm-4" title="Click here to maintain inventory.">
                                    <div class="card">
                                        <a href="@if ($route->shop_status !== 'C') {{ url('mob/customer/profile') }}/{{ $route->task_id }}/{{ $route->shop_id }} @else # @endif"
                                            class="text-reset">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-4">
                                                        <div class="avatar-md">
                                                            <span class="avatar-title rounded-circle bg-light text-danger font-size-22">
                                                                @if (isset($route->customer))
                                                                    {{-- <img src="{{ asset($route->customer->shop_image) }}"
                                                                        alt="{{ $route->customer->shop_name }}"
                                                                        height="55">
                                                                @else --}}
                                                                    {{ $route->sequence }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="text-truncate font-size-15"><span
                                                                class="text-dark">{{ $route->customer->shop_name }}</span>
                                                        </h5>
                                                        <p class="text-muted mb-4">Owner: {{ $route->customer->owner }}
                                                        </p>
                                                        <div class="avatar-group">
                                                            Note: {{ $route->remarks }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="px-4 py-3 border-top">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-3">
                                                    <span class="badge bg-success">{{ $route->status_name }}</span>
                                                </li>
                                                <li class="list-inline-item me-3" title="Updated At">
                                                    <i class="bx bx-calendar me-1"></i>{{ $route->updated_at }}
                                                </li>
                                                <li class="list-inline-item me-3" title="Shop Status">
                                                    <i class="bx bx-info-circle me-1"></i> {{ $route->shop_sts_name }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    <form id="form-route" method="post"
                                        action="{{ url('mob/task/route/update') }}/{{ $route->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="mb-3">
                                            <label class="control-label">Task Status</label>
                                            <select id="task_status" name="task_status" class="form-control select2"
                                                @if ($route->shop_status === 'C') disabled @endif>
                                                @if (isset($task_status) && count($task_status) > 0)
                                                    @foreach ($task_status as $status)
                                                        <option value="{{ $status->lov_code }}"
                                                            @if ($route->status === $status->lov_code) selected @endif>
                                                            {{ $status->lov_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="control-label">Shop Status</label>
                                            <select id="shop_status" name="shop_status" class="form-control select2"
                                                @if ($route->shop_status === 'C') disabled @endif>
                                                @if (isset($shop_status) && count($shop_status) > 0)
                                                    @foreach ($shop_status as $status)
                                                        <option value="{{ $status->lov_code }}"
                                                            @if ($route->shop_status === $status->lov_code) selected @endif>
                                                            {{ $status->lov_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <button id="update-route" type="submit"
                                                                class="btn btn-primary waves-effect waves-light"
                                                                @if ($route->shop_status === 'C') disabled @endif>Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-4 col-sm-4">
                                    @if ($route->shop_status !== 'C' && $route->shop_image == null)
                                        <h4 class="card-title mb-3">Shop Image</h4>
                                        <form method="post"
                                            action="{{ url('/mob/task/route/upload') }}/{{ $route->id }}"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="task_id" id="task_id"
                                                value="{{ $task->id }}" />
                                            <div class="input-group">
                                                <input name="shopimgfile" type="file" class="form-control"
                                                    id="shopimgfile" aria-describedby="shopimg" aria-label="Upload">
                                                <button class="btn btn-primary" type="submit"
                                                    id="shopimg">Upload</button>
                                            </div>
                                        </form>
                                    @else
                                        @if ($route->shop_image != null)
                                            <form method="post"
                                                action="{{ url('/mob/task/route/upload/delete') }}/{{ $route->id }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="task_id" id="task_id"
                                                    value="{{ $task->id }}" />
                                                <div class="flex-shrink-0 me-4">
                                                    <div class="avatar-md">
                                                        <span class="avatar-title rounded-circle bg-light text-danger">
                                                            <img src="{{ asset($route->shop_image) }}" height="55" />
                                                        </span>
                                                    </div>
                                                </div>
                                                <button type="submit" name="delshopimg"
                                                    class="btn action-icon text-danger" title="Delete"><i
                                                        class="mdi mdi-trash-can"></i></button>
                                            </form>
                                        @else
                                            No shop image taken.
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <hr />
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
