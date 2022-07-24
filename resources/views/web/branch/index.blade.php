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
            Branch
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><button class="btn btn-primary waves-effect waves-light" type="button"
                                data-bs-toggle="modal" data-bs-target="#addBranchModal">Add Branch</button></div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive  nowrap w-100" id="branchTable" width="100%"
                            cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center d-none">#ID</th>
                                    <th class="text-center d-none">State Code</th>
                                    <th class="text-center">State</th>
                                    <th class="text-center">Branch Code</th>
                                    <th class="text-center">Branch Name</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($branches) && count($branches) > 0)
                                    @foreach ($branches as $b)
                                        <tr>
                                            <td class="text-center d-none">{{ $b->id }}</td>
                                            <td class="text-center d-none">{{ $b->state_code }}</td>
                                            <td class="text-center">{{ $b->state_name }}</td>
                                            <td class="text-center">{{ $b->branch_code }}</td>
                                            <td class="text-center">{{ $b->branch_name }}</td>
                                            <td class="text-center">{{ $b->created_at }}</td>
                                            <td class="text-center">
                                                <a data-bs-target="#editBranchModal" data-bs-toggle="modal" title="Edit"
                                                    data-branch="{{ $b }}" class="text-success"><i
                                                        class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a data-bs-target="#deleteBranchModal" data-bs-toggle="modal" title="Delete"
                                                    data-branch="{{ $b }}" class="text-danger"><i
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
    <div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-plus"></i> Add</strong>&nbsp;Branch
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-4">
                        <form method="POST" class="form-horizontal" action="{{ url('web/branch/create') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="state_code" class="form-label">State</label>
                                <select class="form-select" class="form-control" id="state_code" name="state_code" required>
                                    <option value="">Please select</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->lov_code }}">{{ $state->lov_name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="branch_code" class="form-label">Branch Code</label>
                                <input type="text" class="form-control @error('branch_code') is-invalid @enderror"
                                    id="branch_code" value="{{ old('branch_code') }}" name="branch_code"
                                    placeholder="Enter Branch Code" autofocus required>
                                @error('branch_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="branch_name" class="form-label">Branch Name</label>
                                <input type="text" class="form-control @error('branch_name') is-invalid @enderror"
                                    value="{{ old('branch_name') }}" id="branch_name" name="branch_name" autofocus
                                    required placeholder="Enter Branch Name">
                                @error('branch_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
    <div class="modal fade" id="editBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-edit"></i> Update</strong>&nbsp;Branch
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/branch/update') }}" method="post"
                        class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input id="id" name="id" type="hidden" value=""
                                class="_id form-control">
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="erole">State<span
                                        class="text-danger">*</span>:</label>
                                <select id="estate" name="estate" class="estate form-control col-md-6">
                                    @foreach ($states as $state)
                                        <option value="{{ $state->lov_code }}">{{ $state->lov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="ebrncd">Branch Code<span
                                        class="text-danger">*</span>:</label>
                                <input id="ebrncd" name="ebrncd" type="text" class="ebrncd form-control col-md-6"
                                    value="">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="ebrnname">Branch Name<span
                                        class="text-danger">*</span>:</label>
                                <input id="ebrnname" name="ebrnname" type="text"
                                    class="ebrnname form-control col-md-6" value="">
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
    <div class="modal fade" id="deleteBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="far fa-trash-alt"></i>&nbsp;Delete</strong>&nbsp;Branch</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/branch/delete') }}" method="post"
                        class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input id="brnid" name="brnid" type="hidden" value="" class="form-control">
                            <p>Are you sure to delete <strong><span id="dbranch"></span></strong>?</p>
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
            var branchTable = $('#branchTable').DataTable();

            $('#branchTable tbody').on('click', 'tr', function() {
                var branch = branchTable.row(this).data();

                $('._id').val(branch[0]);
                $('.estate').val(branch[1]);
                $('.ebrncd').val(branch[3]);
                $('.ebrnname').val(branch[4]);
                $('#createdat').val(branch[5]);

                $('#brnid').val(branch[0]);
                document.getElementById("dbranch").textContent = branch[4];
            });
        });
    </script>
@endsection
