@extends('layouts.mob.master')

@section('title')
@endsection

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="row g-0">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <form id="search_form" action="{{ url('#') }}">
                        <input id="search_field" type="text" placeholder="Search Customer/Shop" name="search">
                        <button id="search_button">
                            <span class="bx bx-search-alt search_icon"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row g-0 customer-list">
            <a href="{{ url('mob/customer/profile') }}"
                class="text-decoration-underline text-reset">
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="text-center p-1">
                                    <div class="avatar-sm mx-auto mb-3 mt-1">
                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                            A
                                        </span>
                                    </div>
                                    <h5 class="text-truncate pb-1">Customer A</h5>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="p-4 text-center text-xl-start">
                                    <div class="row">
                                        <div class="col-5">
                                            <div>
                                                <p class="text-muted mb-2 text-truncate">Stock</p>
                                                <h5>45</h5>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div>
                                                <p class="text-muted mb-2 text-truncate">Last Visit</p>
                                                <h5>2/2/22</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="text-center p-4">
                                <div class="avatar-sm mx-auto mb-3 mt-1">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                        B
                                    </span>
                                </div>
                                <h5 class="text-truncate pb-1">Customer B</h5>
                            </div>
                        </div>

                        <div class="col-xl-7">
                            <div class="p-4 text-center text-xl-start">
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <p class="text-muted mb-2 text-truncate">Data A</p>
                                            <h5>INFO</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div>
                                            <p class="text-muted mb-2 text-truncate">Data B</p>
                                            <h5>INFO</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ url('mob/customer/profile') }}"
                                        class="text-decoration-underline text-reset">See Profile <i
                                            class="mdi mdi-arrow-right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="text-center p-1">
                                <div class="avatar-sm mx-auto mb-3 mt-1">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                        B
                                    </span>
                                </div>
                                <h5 class="text-truncate pb-1">Customer C</h5>
                            </div>
                        </div>

                        <div class="col-xl-7">
                            <div class="p-4 text-center text-xl-start">
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <p class="text-muted mb-2 text-truncate">Data A</p>
                                            <h5>INFO</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div>
                                            <p class="text-muted mb-2 text-truncate">Data B</p>
                                            <h5>INFO</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ url('mob/customer/profile') }}"
                                        class="text-decoration-underline text-reset">See Profile <i
                                            class="mdi mdi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0 fixed-footer">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-grid mt-2">
                        <a href="{{ url('/mob/customer/register') }}" class="btn btn-primary btn-block">Register New
                            Customer</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script type="text/javascript">
        $('#search_button').on('click', function() {
        })
    </script>
@endsection
