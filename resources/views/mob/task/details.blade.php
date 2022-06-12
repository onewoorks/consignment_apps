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
                    <h4 class="card-title">Customer Routes</h4>

                    @if (isset($task->routes))
                        @foreach ($task->routes as $route)
                            <div class="col-xl-4 col-sm-6">
                                <div class="card">
                                    <a href="{{ url('mob/customer/profile') }}/{{ $route->task_id }}/{{ $route->shop_id }}"
                                        class="text-reset">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-4">
                                                    <div class="avatar-md">
                                                        <span
                                                            class="avatar-title rounded-circle bg-light text-danger">
                                                            @if (isset($route->customer))
                                                                <img src="{{ asset($route->customer->shop_image) }}"
                                                                    alt="{{ $route->customer->shop_name }}" height="55">
                                                            @else
                                                                {{ $route->sequence }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-15"><span
                                                            class="text-dark">{{ $route->customer->shop_name }}</span>
                                                    </h5>
                                                    <p class="text-muted mb-4">Owner: {{ $route->customer->owner }}</p>
                                                    <div class="avatar-group">
                                                        @if (isset($task->users))
                                                            Assignee:<ul>
                                                                @foreach ($task->users as $user)
                                                                    <div class="avatar-group-item">
                                                                        <li>{{ $user->user_id }}</li>
                                                                    </div>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="px-4 py-3 border-top">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-3">
                                                <span class="badge bg-success">{{ $route->status }}</span>
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <i class="bx bx-calendar me-1"></i>{{ $route->updated_at }}
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <i class="bx bx-info-circle me-1"></i> {{ $route->shop_status }}
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
