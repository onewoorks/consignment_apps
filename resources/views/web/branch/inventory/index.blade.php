@extends('layouts.web.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <style type="text/css">
        .consignment-tspin {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Branch Inventory
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><button class="btn btn-primary waves-effect waves-light" type="button"
                                data-bs-toggle="modal" data-bs-target="#addBranchInvModal">Add Branch Inventory</button>
                        </div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive  nowrap w-100" id="branchInvTable" width="100%"
                            cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center d-none">#ID</th>
                                    <th class="text-center d-none">Branch Code</th>
                                    <th class="text-center">Branch Name</th>
                                    <th class="text-center d-none">Product Code</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Available Quantity</th>
                                    <th class="text-center">Price Per Unit</th>
                                    <th class="text-center">Total Price (RM)</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center d-none">Updated At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($inventories) && count($inventories) > 0)
                                    @foreach ($inventories as $inv)
                                        <tr>
                                            <td class="text-center d-none">{{ $inv->id }}</td>
                                            <td class="text-center d-none">{{ $inv->branch_code }}</td>
                                            <td class="text-center">{{ $inv->branch_code.' - '.$inv->branch_name }}</td>
                                            <td class="text-center d-none">{{ $inv->product_code }}</td>
                                            <td class="text-center">{{ $inv->product_code.' - '.$inv->product_name }}</td>
                                            <td class="text-center">{{ $inv->quantity }}</td>
                                            <td class="text-center">{{ $inv->price_per_unit }}</td>
                                            <td class="text-center">{{ number_format($inv->total_price, 2) }}</td>
                                            <td class="text-center">{{ $inv->created_at }}</td>
                                            <td class="text-center d-none">{{ $inv->updated_at }}</td>
                                            <td class="text-center">
                                                <a data-bs-target="#editBranchInvModal" data-bs-toggle="modal"
                                                    title="Edit" data-inventory="{{ $inv }}"
                                                    class="text-success"><i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a data-bs-target="#deleteBranchInvModal" data-bs-toggle="modal"
                                                    title="Delete" data-inventory="{{ $inv }}"
                                                    class="text-danger"><i class="mdi mdi-delete font-size-18"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="modal fade" id="addBranchInvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-plus"></i> Add</strong>&nbsp;Branch Inventory
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form-horizontal" action="{{ url('web/branch/inventory/create') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="branch_code" class="form-label">Branch</label>
                            <select class="form-select" class="form-control" id="branch_code" name="branch_code" required>
                                <option value="">Please select</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->branch_code }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                            @error('branch_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="product_code" class="form-label">Product</label>
                            <select class="form-select" class="form-control" id="product_code" name="product_code" required>
                                <option value="">Please select</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->product_code }}">{{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input id="quantity" name="quantity" data-toggle="touchspin" type="text" value="0"
                                class="form-control consignment-tspin">
                        </div>
                        <div class="mb-3">
                            <label for="price_per_unit">Price Per Unit:</label>
                            <input data-toggle="touchspin" id="price_per_unit" name="price_per_unit" type="text"
                                value="0.00" class="form-control consignment-tspin" data-bts-prefix="RM">
                        </div>
                        <div class="mt-4 d-grid">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBranchInvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-edit"></i> Update</strong>&nbsp;Branch Inventory
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/branch/inventory/update') }}" method="post"
                        class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input id="id" name="id" type="hidden" value=""
                                class="_id form-control">
                            <div class="mb-3">
                                <label for="branch_code" class="form-label">Branch</label>
                                <select class="form-select" class="ebranchCode form-control" id="branch_code"
                                    name="branch_code" required>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->branch_code }}">{{ $branch->branch_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_code" class="form-label">Product</label>
                                <select class="form-select" class="eproductCode form-control" id="product_code"
                                    name="product_code" required>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->product_code }}">{{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input id="quantity" name="quantity" data-toggle="touchspin" type="text"
                                    value="0" class="equantity form-control consignment-tspin">
                            </div>
                            <div class="mb-3">
                                <label for="price_per_unit">Price Per Unit:</label>
                                <input data-toggle="touchspin" id="price_per_unit" name="price_per_unit" type="text"
                                    value="0.00" class="epriceperunit form-control consignment-tspin"
                                    data-bts-prefix="RM">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="createdat">Created At:</label>
                                <input id="createdat" name="createdat" type="text"
                                    class="ecreatedat form-control col-md-6" value="" readonly>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="updatedat">Updated At:</label>
                                <input id="updatedat" name="updatedat" type="text"
                                    class="eupdatedat form-control col-md-6" value="" readonly>
                            </div>
                        </fieldset>
                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteBranchInvModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="far fa-trash-alt"></i>&nbsp;Delete</strong>&nbsp;Branch Inventory</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/branch/inventory/delete') }}" method="post"
                        class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input id="brninvid" name="brninvid" type="hidden" value="" class="form-control">
                            <p>Are you sure to delete <strong><span id="delbranchinv"></span></strong>?</p>
                            <p>&nbsp;</p>
                        </fieldset>
                        <div class="mt-3 d-grid">
                            <button class="btn btn-danger waves-effect waves-light" type="submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/mob/customer-wizard.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var branchInvTable = $('#branchInvTable').DataTable();

            $('#branchInvTable tbody').on('click', 'tr', function() {
                var branch = branchInvTable.row(this).data();

                $('._id').val(branch[0]);
                $('.ebranchcode').val(branch[1]);
                $('.eproductcode').val(branch[3]);
                $('.equantity').val(branch[5]);
                $('.epriceperunit').val(branch[6]);
                $('.ecreatedat').val(branch[8]);
                $('.eupdatedat').val(branch[9]);

                $('#brninvid').val(branch[0]);
                document.getElementById("delbranchinv").textContent = branch[2] + '-' + branch[4];
            });

            $("input[name='quantity']").TouchSpin({
                verticalbuttons: 0,
                buttondown_class: "btn btn-success",
                buttonup_class: "btn btn-success"
            });
            $("input[name='price_per_unit']").TouchSpin({
                verticalbuttons: 0,
                decimals: 2,
                step: 0.01
            });
        });
    </script>
@endsection
