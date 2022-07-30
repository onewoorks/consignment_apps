@extends('layouts.web.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Team
        @endslot
        @slot('title')
            Team Member
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-md">
                                <span class="avatar-title rounded-circle bg-light text-danger font-size-22">
                                    @if (isset($team->team_name))
                                        {{ $team->team_name }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="flex-grow-1 align-self-center">
                            <div class="text-muted">
                                <p class="mb-2">Welcome to Consignment Team</p>
                                <h5 class="mb-1">Team Name: {{ $team->team_name }}</h5>
                                <p class="mb-0">Description: {{ $team->remarks }}</p>
                                <p class="mb-0">Created At: {{ $team->created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><button class="btn btn-primary waves-effect waves-light" type="button"
                                data-bs-toggle="modal" data-bs-target="#addTeamMemberModal">Add Team Member</button></div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive  nowrap w-100" id="teamMemberTable" width="100%"
                            cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center d-none">#ID</th>
                                    <th class="text-center">User ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Date Joined</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($members) && count($members) > 0)
                                    @foreach ($members as $member)
                                        <tr>
                                            <td class="text-center d-none">{{ $member->id }}</td>
                                            <td class="text-center">{{ $member->user_id }}</td>
                                            <td class="text-center">{{ $member->name }}</td>
                                            <td class="text-center">{{ $member->role }}</td>
                                            <td class="text-center">{{ $member->date_joined }}</td>
                                            <td class="text-center">{{ $member->created_at }}</td>
                                            <td class="text-center">
                                                <a data-bs-target="#editTeamMemberModal" data-bs-toggle="modal"
                                                    title="Edit" data-member="{{ $member }}"
                                                    class="text-success"><i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a data-bs-target="#deleteTeamMemberModal" data-bs-toggle="modal"
                                                    title="Delete" data-member="{{ $member }}" class="text-danger"><i
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
    <div class="modal fade" id="addTeamMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-plus"></i> Add</strong>&nbsp;Team Member
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form-horizontal" action="{{ url('web/team/create') }}">
                        @csrf
                        <input id="team_id" name="team_id" type="hidden" value="{{ $team->id }}"
                            class="_id form-control">
                        <div class="form-group form-inline">
                            <label for="user_id" class="form-label">Member ID</label>
                            <select class="form-select" class="form-control" id="user_id" name="user_id" required>
                                <option value="">Please select</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" id="name" name="name" autofocus
                                placeholder="Enter User Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group form-inline">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" class="form-control" id="role" name="role" required>
                                <option value="">Please select</option>
                                @foreach ($member_roles as $role)
                                    <option value="{{ $role->lov_code }}">{{ $role->lov_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date_joined" class="form-label">Date Joined</label>
                            <div class="input-group" id="datepicker2">
                                <input id="date_joined" name="date_joined" type="text" class="form-control"
                                    placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                    data-date-container='#datepicker2' data-provide="datepicker"
                                    data-date-autoclose="true">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="mt-4 d-grid">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editTeamMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-edit"></i> Update</strong>&nbsp;Team Member
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/team/update') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input id="id" name="id" type="hidden" value=""
                                class="_id form-control">
                            <input id="team_id" name="team_id" type="hidden" value="{{ $team->id }}"
                                class="form-control">
                            <div class="form-group form-inline">
                                <label for="user_id" class="form-label">Member ID</label>
                                <select class="form-select" class="euserid form-control" id="user_id" name="user_id"
                                    required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="ename form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" id="name" name="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group form-inline">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" class="erole form-control" id="role" name="role"
                                    required>
                                    @foreach ($member_roles as $role)
                                        <option value="{{ $role->lov_code }}">{{ $role->lov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date_joined" class="form-label">Date Joined</label>
                                <div class="input-group" id="datepicker2">
                                    <input id="date_joined" name="date_joined" type="text"
                                        class="edatejoined form-control" placeholder="yyyy-mm-dd"
                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                        data-provide="datepicker" data-date-autoclose="true">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
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
    <div class="modal fade" id="deleteTeamMemberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="far fa-trash-alt"></i>&nbsp;Delete</strong>&nbsp;Team Member</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/team/member/delete') }}" method="post"
                        class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input id="team_id" name="team_id" type="hidden" value="{{ $team->id }}"
                                class="form-control">
                            <input id="uid" name="uid" type="hidden" value="" class="form-control">
                            <p>Are you sure to delete <strong><span id="dteammember"></span></strong>?</p>
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
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#date_joined').datepicker('setDate', today);

        $(document).ready(function() {
            var teamMemberTable = $('#teamMemberTable').DataTable();

            $('#teamMemberTable tbody').on('click', 'tr', function() {
                var member = teamMemberTable.row(this).data();

                $('._id').val(member[0]);
                $('.euserid').val(member[1]);
                $('.ename').val(member[2]);
                $('.erole').val(member[3]);
                $('.edatejoined').val(member[4]);
                $('#createdat').val(member[5]);

                $('#uid').val(member[0]);
                document.getElementById("dteammember").textContent = member[1];
            });
        });
    </script>
@endsection
