@extends('layouts.mob.master')

@section('title')
@endsection

@section('css')
    <style>
        form#search_form {
            background-color: #d6d8eb;
            width: auto;
            height: 44px;
            border-radius: 5px;
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        input#search_field {
            all: unset;
            font: 16px system-ui;
            color: rgb(34, 33, 33);
            height: 100%;
            width: 100%;
            padding: 6px 10px;
        }

        ::placeholder {
            color: #fff;
            opacity: 0.7;
        }

        .search_icon {
            color: #fff;
            fill: currentColor;
            width: 24px;
            height: 24px;
            padding: 10px;
        }

        button#search_button {
            all: unset;
            cursor: pointer;
            width: 44px;
            height: 44px;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="row">
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
        <div class="row">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="text-center p-4 border-end">
                                <div class="avatar-sm mx-auto mb-3 mt-1">
                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                        B
                                    </span>
                                </div>
                                <h5 class="text-truncate pb-1">Customer A</h5>
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
                            <div class="text-center p-4 border-end">
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
                            <div class="text-center p-4 border-end">
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
        <div class="row">
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
