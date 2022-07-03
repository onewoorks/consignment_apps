@extends('layouts.mob.master')

@section('title')
@endsection

@section('css')
    <style>
        form#search_form {
            background-color: #eff0f5;
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
            color: rgb(12, 12, 12);
            height: 100%;
            width: 100%;
            padding: 6px 10px;
        }

        ::placeholder {
            color: rgb(19, 18, 19);
            opacity: 0.7;
        }

        .search_icon {
            color: rgb(12, 12, 12);
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
        <div class="row g-0">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <form id="search_form" method="get" action="{{ url('mob/customer/list') }}/{{ Auth::user()->name }}">
                        <input id="search_field" type="text" placeholder="Search Customer" name="search">
                        <button type="submit" id="search_button">
                            <span class="bx bx-search-alt search_icon"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row g-0 customer-list">
            @if (isset($customers) && count($customers) > 0)
                @foreach ($customers as $customer)
                    <a id="customers[]" data-customer="{{ $customer }}"
                        href="{{ url('mob/customer/profile') }}/{{ $customer->task_id . '/' . $customer->id }}"
                        class="text-decoration-underline text-reset">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-center p-1">
                                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                    <img src="{{ asset($customer->shop_image) }}"
                                                        alt="{{ $customer->shop_name }}" height="55">
                                                </span>
                                            </div>
                                            <h5 class="text-truncate pb-1">{{ $customer->shop_name }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="p-4 text-center text-xl-start">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row text-center">
                                                        <div class="col-sm-5">
                                                            <p class="text-muted mb-2 text-truncate">Stock</p>
                                                            <h5>{{ $customer->total_stock }}</h5>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <p class="text-muted mb-2 text-truncate">Amount (RM)</p>
                                                            <h5>{{ $customer->total_amount }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div>
                                                        <p class="text-muted mb-2 text-truncate">Last Visit</p>
                                                        <h5>{{ $customer->last_visit != null ? $customer->last_visit : 'NA' }}
                                                        </h5>
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
                    No Customers Found!
                </div>
            @endif
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
    <!-- end row -->
@endsection
@section('script')
    <script type="text/javascript"></script>
@endsection
