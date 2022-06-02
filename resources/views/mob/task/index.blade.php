@extends('layouts.mob.master')

@section('title')
    @lang('translation.CreateTask')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">@lang('translation.CreateTask')</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Task Info</h4>
                    <p class="card-title-desc">Fill all information below</p>
                    @if (isset($status))
                        @if (isset($status) && $status === 1)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bx bx-check-circle"></i>
                                {{ $msg }} #ID {{ $shop_id }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @else
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bx bx-error-alt"></i>
                                {{ $msg }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    @endif
                    <form id="form-task" method="post" action="{{ url('/mob/task/create') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="task_name">Task Name</label>
                                    <input id="task_name" name="task_name" type="text" class="form-control"
                                        placeholder="Task Name">
                                </div>
                                <div class="mb-3">
                                    <label class="control-label">Team</label>
                                    <select id="team_id" name="team_id" class="form-control col-sm-3 select2">
                                        <option>Select</option>
                                        @if (isset($team))
                                            <option value="{{ $team->team_id }}">{{ $team->team_name }}
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="control-label">Add Team Member</label>
                                    <select name="members[]" class="select2 form-control col-sm-3 select2-multiple"
                                        multiple="multiple" data-placeholder="Choose ...">
                                        @if (isset($members) && count($members) > 0)
                                            @foreach ($members as $m)
                                                <option value="{{ $m->user_id }}">{{ $m->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="remarks">Task Description</label>
                                    <textarea class="form-control" name="remarks" id="remarks" rows="5" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="control-label">Status</label>
                                    <select id="task_status" name="task_status" class="form-control col-sm-3 select2">
                                        <option>Select</option>
                                        @if (isset($task_status) && count($task_status) > 0)
                                            @foreach ($task_status as $status)
                                                <option value="{{ $status->lov_code }}">{{ $status->lov_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="start_time">Start Time</label>
                                    <input name="start_time" class="form-control" type="datetime-local"
                                        placeholder="Start Time" id="start_time">
                                </div>
                                <div class="mb-3">
                                    <label for="end_time">End Time</label>
                                    <input name="end_time" class="form-control" type="datetime-local"
                                        placeholder="End Time" id="end_time">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button type="submit" id="save-task"
                                                class="btn btn-primary waves-effect waves-light">Save
                                                Changes</button>
                                            <button type="reset" id="reset-task"
                                                class="btn btn-secondary waves-effect waves-light">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-select2.init.js') }}"></script>

    <script type="text/javascript">
        $('#team_id').on('change', function() {
            var team = $(this).val();
            console.log(team);

            $.ajax({
                url: '/api/v1/member/list',
                type: "POST",
                data: {
                    'id': team
                },
                success: function(data) {
                    var options = '';
                    if (data.length > 0) {
                        data.forEach(function(d) {
                            options += '<option value = "' + d.user_id + '">' + d.name +
                                '</option>';
                        });
                    }

                    $('select[name="members[]"]').html(options);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        })
    </script>
@endsection
