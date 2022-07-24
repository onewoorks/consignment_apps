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
            User
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><button class="btn btn-primary waves-effect waves-light" type="button"
                                data-bs-toggle="modal" data-bs-target="#addUserModal">Add New User</button></div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive  nowrap w-100" id="userTable" width="100%"
                            cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" hidden>#ID</th>
                                    <th class="text-center">User Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">DOB</th>
                                    <th class="text-center">Created Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($users) && count($users) > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center" hidden>{{ $user->id }}</td>
                                            <td class="text-center">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">{{ $user->role }}</td>
                                            <td class="text-center">{{ $user->dob }}</td>
                                            <td class="text-center">{{ $user->created_at }}</td>
                                            <td class="text-center">
                                                <a data-bs-target="#editUserModal" data-bs-toggle="modal" title="Edit"
                                                    data-user="{{ $user }}" class="text-success"><i
                                                        class="mdi mdi-pencil font-size-18"></i></a>
                                                <a data-bs-target="#deleteUserModal" data-bs-toggle="modal" title="Delete"
                                                    data-user="{{ $user }}" class="text-danger"><i
                                                        class="mdi mdi-delete font-size-18"></i></a>
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
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-plus"></i> Add</strong>&nbsp;New User
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-4">
                        <form method="POST" class="form-horizontal" action="{{ url('web/user/create') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="useremail" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="useremail" value="{{ old('email') }}" name="email" placeholder="Enter email"
                                    autofocus required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" id="username" name="name" autofocus required
                                    placeholder="Enter username">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="userpassword" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="userpassword" name="password" placeholder="Enter password" autofocus required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="confirmpassword" class="form-label">Confirm
                                    Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="confirmpassword" name="password_confirmation"
                                    placeholder="Enter Confirm password" autofocus required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" class="form-control" id="role" name="role" required>
                                    <option>Please select</option>
                                    <option value="agent">Agent</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="userdob">Date of Birth</label>
                                <div class="input-group" id="datepicker1">
                                    <input type="text" class="form-control @error('dob') is-invalid @enderror"
                                        placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy"
                                        data-date-container='#datepicker1' data-date-end-date="0d"
                                        value="{{ old('dob') }}" data-provide="datepicker" name="dob" autofocus
                                        required>
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="avatar">Profile Picture</label>
                                <div class="input-group">
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                        id="inputGroupFile02" name="avatar" autofocus required>
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="fa fa-edit"></i> Update</strong>&nbsp;User
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/user/update') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input id="id" name="id" type="hidden" value=""
                                class="_id form-control">
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="name">Name<span
                                        class="text-danger">*</span>:</label>
                                <input id="name" name="name" type="text" class="name form-control col-md-6"
                                    value="">
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="email">Email<span
                                        class="text-danger">*</span>:</label>
                                <input id="email" name="email" type="text" class="email form-control col-md-6"
                                    value="" readonly>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="erole">Role<span
                                        class="text-danger">*</span>:</label>
                                <select id="erole" name="erole" class="erole form-control col-md-6">
                                    @foreach ($user_roles as $role)
                                        <option value="{{ $role->lov_code }}">{{ $role->lov_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-inline">
                                <label class="control-label col-md-4" for="userdob">Date of Birth</label>
                                <div class="input-group" id="datepicker2">
                                    <input type="text" class="form-control edob" placeholder="dd-mm-yyyy"
                                        data-date-format="dd-mm-yyyy" data-date-container='#datepicker2'
                                        data-date-end-date="0d" data-provide="datepicker" name="dob" autofocus
                                        id="dob">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
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
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="far fa-trash-alt"></i>&nbsp;Delete</strong>&nbsp;User</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/user/delete') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input id="uid" name="uid" type="hidden" value="" class="form-control">
                            <p>Are you sure to delete <strong><span id="uname"></span></strong>?</p>
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
            var userTable = $('#userTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });

            $('#userTable tbody').on('click', 'tr', function() {
                var user = userTable.row(this).data();

                $('._id').val(user[0]);
                $('.name').val(user[1]);
                $('.email').val(user[2]);
                $('.erole').val(user[3]);
                $('.edob').val(user[4]);
                $('#createdDate').val(user[5]);

                $('#uid').val(user[0]);
                document.getElementById("uname").textContent = user[1];
            });
        });
    </script>
@endsection
