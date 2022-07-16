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
                    <div class="table-responsive">
                        <table id="usertable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>DOB</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($users) && count($users) > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td style="text-align:left;"><a
                                                    href="{{ url('profile') }}/{{ $user->id }}">{{ $user->name }}</a>
                                            </td>
                                            <td style="text-align:center;">{{ $user->email }}</td>
                                            <td style="text-align:center;">{{ $user->role }}</td>
                                            <td style="text-align:center;">{{ $user->dob }}</td>
                                            <td style="text-align:center;">{{ $user->created_at }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle card-drop"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a href="#" class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target=".update-profile"><i
                                                                    class="mdi mdi-pencil font-size-16 text-success me-1"></i>
                                                                Edit</a></li>
                                                        <li>
                                                            <form class="dropdown-item" method="post"
                                                                action="{{ url('web/user/delete') }}/{{ $user->id }}">
                                                                {{ csrf_field() }}
                                                                {{ method_field('delete') }}
                                                                <button type="submit" name="deluser"
                                                                    class="btn action-icon" title="Delete User"><i
                                                                        class="mdi mdi-trash-can font-size-16 text-danger me-1"></i>
                                                                    Delete</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
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
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript">
        $("#usertable").DataTable();
    </script>
@endsection
