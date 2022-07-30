@extends('layouts.web.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Shop
        @endslot
    @endcomponent

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="search-box me-2 mb-2 d-inline-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="text-sm-end">
                            <button type="button"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i
                                    class="mdi mdi-plus me-1"></i> Add New Shop</button>
                        </div>
                    </div><!-- end col-->
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="row">
                    <div class="col-xl-5">
                        <div class="text-center p-4 border-end">
                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                    B
                                </span>
                            </div>
                            <h5 class="text-truncate pb-1">Shop A</h5>
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="p-4 text-center text-xl-start">
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <p class="text-muted mb-2 text-truncate">Products</p>
                                        <h5>112</h5>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        <p class="text-muted mb-2 text-truncate">Wallet Balance</p>
                                        <h5>$13,575</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="#" class="text-decoration-underline text-reset">See Details <i
                                        class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  end row -->
@endsection
@section('script')
@endsection
