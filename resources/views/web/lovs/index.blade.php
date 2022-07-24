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
            Data Lookup
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><button class="btn btn-primary waves-effect waves-light" type="button"
                                data-bs-toggle="modal" data-bs-target="#addLovModal">Add Data Lookup</button></div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive  nowrap w-100" id="lovTable" width="100%"
                            cellspacing="0"">
                            <thead class="table-light">
                                <tr class="beta-tr">
                                    <th class="text-center d-none">#ID</th>
                                    <th class="text-center">Lov Category</th>
                                    <th class="text-center">Lov Code</th>
                                    <th class="text-center">Lov Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Is Required?</th>
                                    <th class="text-center">Is Default?</th>
                                    <th class="text-center">Created Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($lovs) && count($lovs) > 0)
                                    @foreach ($lovs as $lov)
                                        <tr>
                                            <td class="text-center d-none">{{ $lov->id }}</td>
                                            <td class="text-center">{{ $lov->lov_category }}</td>
                                            <td class="text-center">{{ $lov->lov_code }}</td>
                                            <td class="text-center">{{ $lov->lov_name }}</td>
                                            <td class="text-left">{{ $lov->description }}</td>
                                            <td class="text-center">{{ $lov->is_required }}</td>
                                            <td class="text-center">{{ $lov->is_default }}</td>
                                            <td class="text-center">{{ $lov->created_date }}</td>
                                            <td class="text-center">
                                                <a data-bs-target="#editLovModal" data-bs-toggle="modal" title="Edit"
                                                    class="text-success"><i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a data-bs-target="#deleteLovModal" data-bs-toggle="modal" title="Delete"
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
    <div class="modal fade" id="addLovModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-plus"></i>&nbsp;Add New</strong>&nbsp;Data Lookup
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/lov/create') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            <div class="form-group row bg-warning">
                                <label class="col-md-6 col-form-label">New or Existing Lov Category?</label>
                                <div class="col-md-6 col-form-label">
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="newLovCategory" type="radio" value="0"
                                            name="inline-radios" checked>
                                        <label class="form-check-label" for="newLovCategory">New</label>
                                    </div>
                                    <div class="form-check form-check-inline mr-1">
                                        <input class="form-check-input" id="existLovCategory" type="radio" value="1"
                                            name="inline-radios">
                                        <label class="form-check-label" for="existLovCategory">Existing</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="lovCategory">Lov Category<span
                                        class="text-danger">*</span>&nbsp;</label>
                                <input id="lovCategory" name="lovCategory" type="text"
                                    class="nlovCategory form-control col-md-6" placeholder="Enter Lov Category ..."
                                    required>
                                <select style="display: none" id="lovCategory" name="lovCategory"
                                    class="elovCategory form-control col-md-6" data-placeholder="Choose a Lov Category..">
                                    <option value="">Select</option>
                                    @foreach ($categories as $ctgry)
                                        <option value="{{ $ctgry->lov_category }}">{{ $ctgry->lov_category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="lovCode">Lov Code<span
                                        class="text-danger">*</span>&nbsp;</label>
                                <input id="lovCode" name="lovCode" type="text" class="form-control col-md-6"
                                    placeholder="Enter Lov Code ..." required>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="lovName">Lov Name:</label>
                                <input id="lovName" name="lovName" type="text"
                                    class="lovName form-control col-md-8" placeholder="Enter Lov Name ...">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="lovDescription">Lov Description:</label>
                                <input id="lovDescription" name="lovDescription" type="text"
                                    class="form-control col-md-6" placeholder="Enter Lov Description ...">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="isRequired">Is Required?:</label>
                                <select id="isRequired" name="isRequired" class="form-control col-md-6">
                                    <option value="">Select</option>
                                    @foreach ($yesnolov as $lov)
                                        <option value="{{ $lov->lov_code }}">{{ $lov->lov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="isDefault">Is Default?:</label>
                                <select id="isDefault" name="isDefault" class="form-control col-md-6">
                                    <option value="">Select</option>
                                    @foreach ($yesnolov as $lov)
                                        <option value="{{ $lov->lov_code }}">{{ $lov->lov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        <div class="mt-4 d-grid">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editLovModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-edit"></i>&nbsp;Edit</strong>&nbsp;Data Lookup
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/lov/update') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input id="id" name="id" type="hidden" value=""
                                class="_id form-control">
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="lovCategory">Lov Category<span
                                        class="text-danger">*</span>:</label>
                                <input id="lovCategory" name="lovCategory" type="text"
                                    class="lovCategory form-control col-md-6" value="" readonly>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="lovCode">Lov Code<span
                                        class="text-danger">*</span>:</label>
                                <input id="lovCode" name="lovCode" type="text"
                                    class="lovCode form-control col-md-6" value="" readonly>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="lovName">Lov Name:</label>
                                <input id="lovName" name="lovName" type="text"
                                    class="lovName form-control col-md-8" value="">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="lovDescription">Lov Description:</label>
                                <input id="lovDescription" name="lovDescription" type="text"
                                    class="lovDescription form-control col-md-8" value="">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="isRequired">Is Required?:</label>
                                <select id="isRequired" name="isRequired" class="isRequired form-control col-md-6">
                                    @foreach ($yesnolov as $lov)
                                        <option value="{{ $lov->lov_code }}">{{ $lov->lov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="isDefault">Is Default?:</label>
                                <select id="isDefault" name="isDefault" class="isDefault form-control col-md-6">
                                    @foreach ($yesnolov as $lov)
                                        <option value="{{ $lov->lov_code }}">{{ $lov->lov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="createdDate">Created Date:</label>
                                <input id="createdDate" name="createdDate" type="text" class="form-control col-md-6"
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
    <div class="modal fade" id="deleteLovModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title"><i class="far fa-trash-alt"></i> <strong>Delete</strong> Data Lookup</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/lov/delete') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input id="lovid" name="lovid" type="hidden" value="" class="form-control">
                            <p>Are you sure to delete <strong><span id="lovname"></span></strong>?</p><br />
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
    <script>
        $(document).ready(function() {
            var lovTable = $('#lovTable').DataTable({
                order: [
                    [1, 'asc']
                ]
            });

            $('#lovTable tbody').on('click', 'tr', function() {
                var lov = lovTable.row(this).data();
                $('._id').val(lov[0]);
                $('.lovCategory').val(lov[1]);
                $('.lovCode').val(lov[2]);
                $('.lovName').val(lov[3]);
                $('.lovDescription').val(lov[4]);
                $('.isRequired').val(lov[5]);
                $('.isDefault').val(lov[6]);
                $('#createdDate').val(lov[7]);

                $('#lovid').val(lov[0]);
                document.getElementById("lovname").textContent = lov[1] + ':' + lov[2] + '-' + lov[3];
            });

            $('.elovCategory').prop("disabled", true);

            $('#existLovCategory').click(function() {
                $('.elovCategory').show();
                $('.nlovCategory').hide();
                $('.nlovCategory').prop("disabled", true);
                $('.elovCategory').prop("disabled", false);
            });

            $('#newLovCategory').click(function() {
                $('.elovCategory').hide();
                $('.nlovCategory').show();
                $('.nlovCategory').prop("disabled", false);
                $('.elovCategory').prop("disabled", true);
            });
        });
    </script>
@endsection
