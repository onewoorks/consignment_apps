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
            Team
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><button class="btn btn-primary waves-effect waves-light" type="button"
                                data-bs-toggle="modal" data-bs-target="#addTeamModal">Add Team</button></div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive  nowrap w-100" id="teamTable" width="100%"
                            cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center d-none">#ID</th>
                                    <th class="text-center">Team Name</th>
                                    <th class="text-center">Decsription</th>
                                    <th class="text-center">Members</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($teams) && count($teams) > 0)
                                    @foreach ($teams as $team)
                                        <tr>
                                            <td class="text-center d-none">{{ $team->id }}</td>
                                            <td class="text-center">{{ $team->team_name }}</td>
                                            <td class="text-center">{{ $team->remarks }}</td>
                                            <td class="text-center"><a href="{{ url('web/team/member') }}/{{ $team->id }}">Details</a></td>
                                            <td class="text-center">{{ $team->created_at }}</td>
                                            <td class="text-center">
                                                <a data-bs-target="#editTeamModal" data-bs-toggle="modal" title="Edit"
                                                    data-team="{{ $team }}" class="text-success"><i
                                                        class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a data-bs-target="#deleteTeamModal" data-bs-toggle="modal" title="Delete"
                                                    data-team="{{ $team }}" class="text-danger"><i
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
    <div class="modal fade" id="addTeamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-plus"></i> Add</strong>&nbsp;Team
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-4">
                        <form method="POST" class="form-horizontal" action="{{ url('web/team/create') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="team_name" class="form-label">Team Name</label>
                                <input type="text" class="form-control @error('team_name') is-invalid @enderror"
                                    value="{{ old('team_name') }}" id="team_name" name="team_name" autofocus
                                    required placeholder="Enter Team Name">
                                @error('team_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="remarks">Description</label>
                                <textarea class="form-control" name="remarks" id="remarks" rows="5" placeholder="Description"></textarea>
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
    <div class="modal fade" id="editTeamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-edit"></i> Update</strong>&nbsp;Team
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/team/update') }}" method="post"
                        class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input id="id" name="id" type="hidden" value=""
                                class="_id form-control">
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="ebrnname">Team Name<span
                                        class="text-danger">*</span>:</label>
                                <input id="eteamname" name="eteamname" type="text"
                                    class="eteamname form-control col-md-6" value="">
                            </div>
                            <div class="mb-3">
                                <label for="remarks">Description</label>
                                <textarea class="eremarks form-control" name="remarks" id="remarks" rows="5" value=""></textarea>
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
    <div class="modal fade" id="deleteTeamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="far fa-trash-alt"></i>&nbsp;Delete</strong>&nbsp;Team</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/team/delete') }}" method="post"
                        class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input id="teamid" name="teamid" type="hidden" value="" class="form-control">
                            <p>Are you sure to delete <strong><span id="dteam"></span></strong>?</p>
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
            var teamTable = $('#teamTable').DataTable();

            $('#teamTable tbody').on('click', 'tr', function() {
                var team = teamTable.row(this).data();

                $('._id').val(team[0]);
                $('.eteamname').val(team[1]);
                $('.eremarks').val(team[2]);
                $('#createdat').val(team[3]);

                $('#teamid').val(team[0]);
                document.getElementById("dteam").textContent = team[1];
            });
        });
    </script>
@endsection
