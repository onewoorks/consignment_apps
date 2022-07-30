@extends('layouts.web.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Product
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><button class="btn btn-primary waves-effect waves-light" type="button"
                                data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button></div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive  nowrap w-100" id="productTable" width="100%"
                            cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center d-none">#ID</th>
                                    <th class="text-center">Product Category</th>
                                    <th class="text-center">Product Code</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($products) && count($products) > 0)
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="text-center d-none">{{ $product->id }}</td>
                                            <td class="text-center">{{ $product->product_category }}</td>
                                            <td class="text-center">{{ $product->product_code }}</td>
                                            <td class="text-center">{{ $product->product_name }}</td>
                                            <td class="text-center">{{ $product->description }}</td>
                                            <td class="text-center">{{ $product->created_at }}</td>
                                            <td class="text-center">
                                                <a data-bs-target="#editProductModal" data-bs-toggle="modal" title="Edit"
                                                    data-product="{{ $product }}" class="text-success"><i
                                                        class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a data-bs-target="#deleteProductModal" data-bs-toggle="modal"
                                                    title="Delete" data-product="{{ $product }}" class="text-danger"><i
                                                        class="mdi mdi-delete font-size-18"></i>
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
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-plus"></i> Add</strong>&nbsp;Product
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-4">
                        <form method="POST" class="form-horizontal" action="{{ url('web/product/create') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="product_category" class="form-label">Product Category</label>
                                <select class="form-select" class="form-control" id="product_category" name="product_category" required>
                                    <option value="">Please select</option>
                                    @foreach ($prod_categories as $prodCtgry)
                                        <option value="{{ $prodCtgry->lov_code }}">{{ $prodCtgry->lov_name }}</option>
                                    @endforeach
                                </select>
                                @error('product_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_code" class="form-label">Product Code</label>
                                <input type="text" class="form-control @error('product_code') is-invalid @enderror"
                                    id="product_code" value="{{ old('product_code') }}" name="product_code"
                                    placeholder="Enter Product Code" autofocus required>
                                @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                    value="{{ old('product_name') }}" id="product_name" name="product_name" autofocus required
                                    placeholder="Enter Product Name">
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Description"></textarea>
                            </div>
                            <div class="mt-4 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-edit"></i> Update</strong>&nbsp;Product
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/product/update') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input id="id" name="id" type="hidden" value=""
                                class="_id form-control">
                            <div class="form-group form-inline">
                                <label for="product_category" class="form-label">Product Category</label>
                                <select class="form-select" class="eprodctgry form-control" id="product_category" name="product_category" required>
                                    @foreach ($prod_categories as $prodCtgry)
                                        <option value="{{ $prodCtgry->lov_code }}">{{ $prodCtgry->lov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="eprodcode">Product Code<span
                                        class="text-danger">*</span>:</label>
                                <input id="eprodcode" name="eprodcode" type="text" class="eprodcode form-control col-md-6"
                                    value="">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="eprodname">Product Name<span
                                        class="text-danger">*</span>:</label>
                                <input id="eprodname" name="eprodname" type="text"
                                    class="eprodname form-control col-md-6" value="">
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="edesc form-control" name="description" id="description" rows="5" value=""></textarea>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="createdat">Created At:</label>
                                <input id="createdat" name="createdat" type="text" class="form-control col-md-6"
                                    value="" readonly>
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
    <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="far fa-trash-alt"></i>&nbsp;Delete</strong>&nbsp;Product</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/product/delete') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input id="prodid" name="prodid" type="hidden" value="" class="form-control">
                            <p>Are you sure to delete <strong><span id="dproduct"></span></strong>?</p>
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
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var productTable = $('#productTable').DataTable();

            $('#productTable tbody').on('click', 'tr', function() {
                var product = productTable.row(this).data();

                $('._id').val(product[0]);
                $('.eprodctgry').val(product[1]);
                $('.eprodcode').val(product[2]);
                $('.eprodname').val(product[3]);
                $('.edesc').val(product[4]);
                $('#createdat').val(product[5]);

                $('#prodid').val(product[0]);
                document.getElementById("dproduct").textContent = product[3];
            });
        });
    </script>
@endsection
