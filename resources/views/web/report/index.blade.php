@extends('layouts.web.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Report @endslot
@endcomponent

<div class="row">
    <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="text-lg-center">
                            <h5 class="mb-1 font-size-15 text-truncate">Report A</h5>
                            <a href="#" class="text-muted">@Skote</a>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div>
                            <a href="invoices-detail"
                                class="d-block text-primary text-decoration-underline mb-2">Report #14251</a>
                            <h5 class="text-truncate mb-4 mb-lg-5">Monthly Sale</h5>
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item me-3">
                                    <h5 class="font-size-14" data-toggle="tooltip" data-placement="top" title="Amount">
                                        <i class="bx bx-money me-1 text-muted"></i> INFO</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="text-lg-center">
                            <h5 class="mb-1 font-size-15 text-truncate">Report B</h5>
                            <a href="#" class="text-muted">@Skote</a>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div>
                            <a href="invoices-detail"
                                class="d-block text-primary text-decoration-underline mb-2">Report #14252</a>
                            <h5 class="text-truncate mb-4 mb-lg-5">Daily</h5>
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item me-3">
                                    <h5 class="font-size-14" data-toggle="tooltip" data-placement="top" title="Amount">
                                        <i class="bx bx-money me-1 text-muted"></i> INFO</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="text-lg-center">
                            <h5 class="mb-1 font-size-15 text-truncate">Report C</h5>
                            <a href="#" class="text-muted">@Skote</a>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div>
                            <a href="invoices-detail"
                                class="d-block text-primary text-decoration-underline mb-2">Report #14253</a>
                            <h5 class="text-truncate mb-4 mb-lg-5">Yearly</h5>
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item me-3">
                                    <h5 class="font-size-14" data-toggle="tooltip" data-placement="top" title="Amount">
                                        <i class="bx bx-money me-1 text-muted"></i> INFO</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<!-- end row -->

@endsection
@section('script')
@endsection
