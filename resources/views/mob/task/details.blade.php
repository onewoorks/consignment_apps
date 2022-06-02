@extends('layouts.mob.master')

@section('title')
    @lang('translation.TaskRoute')
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Task Info</h4>
                    <p class="card-title-desc">Task #ID {{ $task->id }} Task Name: {{ $task->task_name }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Task Routes by Task Sequence</h4>
                    <p class="card-title-desc">Task #ID {{ $task->id }} Task Name: {{ $task->task_name }}</p>

                    @if (isset($task->routes))
                        @foreach ($task->routes as $route)
                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <a href="{{ url('mob/customer/profile') }}/{{ $route->shop_id }}"
                                        class="text-decoration-underline text-reset">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-4">
                                                    <div class="avatar-md">
                                                        <span
                                                            class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                                            <img src="assets/images/companies/img-1.png" alt="" height="30">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-15"><a href="javascript: void(0);"
                                                            class="text-dark">New admin Design</a></h5>
                                                    <p class="text-muted mb-4">It will be as simple as Occidental</p>
                                                    <div class="avatar-group">
                                                        @if (isset($task->users))
                                                            @foreach ($task->users as $user)
                                                                <div class="avatar-group-item">
                                                                    <a href="javascript: void(0);"
                                                                        title="{{ $user->user_id }}"
                                                                        class="d-inline-block">
                                                                        <img src="assets/images/users/avatar-4.jpg" alt=""
                                                                            class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="px-4 py-3 border-top">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-3">
                                                <span class="badge bg-success">Completed</span>
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <i class="bx bx-calendar me-1"></i> 15 Oct, 19
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <i class="bx bx-comment-dots me-1"></i> 214
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
