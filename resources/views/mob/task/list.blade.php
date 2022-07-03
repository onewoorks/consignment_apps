@extends('layouts.mob.master')

@section('title')
@lang('translation.TaskList')
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Tasks
        @endslot
        @slot('title')
            Task List
        @endslot
    @endcomponent
    <div class="row">
        <div class="row g-0 customer-list">
            @if (isset($tasks) && count($tasks) > 0)
                @foreach ($tasks as $task)
                    <a href="{{ url('mob/task/details') }}/{{ $task->task_id }}"
                        class="text-decoration-underline text-reset">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="text-center p-1">
                                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                    A
                                                </span>
                                            </div>
                                            <h5 class="text-truncate pb-1">{{ $task->task_name }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="p-4 text-center text-xl-start">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div>
                                                        <p class="text-muted mb-2 text-truncate">Task Status</p>
                                                        <h5>{{ $task->status_name }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div>
                                                        <p class="text-muted mb-2 text-truncate">Created At</p>
                                                        <h5>{{ $task->created_at }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-alert-outline me-2"></i>
                    No Tasks Available!
                </div>
            @endif
        </div>
        <!-- end row -->
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script type="text/javascript"></script>
@endsection
