@extends('layouts.mob.master')

@section('title')
@endsection

@section('content')
    <div class="row">
        @if (isset($team_role) && $team_role === 'L')
            <div class="row g-0">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <a href="{{ url('/mob/task') }}">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Create Task</p>
                                    <h4 class="mb-0"></h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="row g-0">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <a href="{{ url('/mob/task/list') }}/{{ Auth::user()->name }}">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Task Assignment</p>
                                <h4 class="mb-0"></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <a href="{{ url('/mob/inventory') }}/{{ Auth::user()->name }}">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Inventory</p>
                                <h4 class="mb-0"></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bx bx-copy-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <a href="{{ url('/mob/customer/list') }}/{{ Auth::user()->name }}">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Customer</p>
                                <h4 class="mb-0"></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-archive-in font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <a href="{{ url('/mob/report') }}">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Sale Reports</p>
                                <h4 class="mb-0"></h4>
                            </div>
                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <a href="{{ url('/profile') }}/{{ Auth::user()->name }}">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Profile</p>
                                <h4 class="mb-0"></h4>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
@endsection
