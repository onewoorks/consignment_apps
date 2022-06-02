@extends('layouts.web.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') State @endslot
@endcomponent

<div class="row">
    <div class="col-12">
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
                                    class="mdi mdi-plus me-1"></i> Add New State</button>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-check">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th class="align-middle">State Code</th>
                                <th class="align-middle">State Name</th>
                                <th class="align-middle">Created Date</th>
                                <th class="align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="orderidcheck01">
                                        <label class="form-check-label" for="orderidcheck01"></label>
                                    </div>
                                </td>
                                <td><a href="javascript: void(0);" class="text-body fw-bold">01</a> </td>
                                <td>Kuala Terengganu</td>
                                <td>
                                    07 Oct, 2019
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a href="javascript:void(0);" class="text-success"><i
                                                class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger"><i
                                                class="mdi mdi-delete font-size-18"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="orderidcheck02">
                                        <label class="form-check-label" for="orderidcheck02"></label>
                                    </div>
                                </td>
                                <td><a href="javascript: void(0);" class="text-body fw-bold">02</a> </td>
                                <td>Dungun</td>
                                <td>
                                    07 Oct, 2019
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a href="javascript:void(0);" class="text-success"><i
                                                class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger"><i
                                                class="mdi mdi-delete font-size-18"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="orderidcheck03">
                                        <label class="form-check-label" for="orderidcheck03"></label>
                                    </div>
                                </td>
                                <td><a href="javascript: void(0);" class="text-body fw-bold">03</a> </td>
                                <td>Kemaman</td>
                                <td>
                                    06 Oct, 2019
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a href="javascript:void(0);" class="text-success"><i
                                                class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger"><i
                                                class="mdi mdi-delete font-size-18"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination pagination-rounded justify-content-end mb-2">
                    <li class="page-item disabled">
                        <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                            <i class="mdi mdi-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="javascript: void(0);" aria-label="Next">
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection
@section('script')
@endsection
