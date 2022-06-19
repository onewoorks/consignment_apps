@extends('layouts.mob.master')

@section('title')
    @lang('translation.CreateTask')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Tasks
        @endslot
        @slot('title')
            Create Task
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-2">
            <div class="accordion" id="task-created">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            See Your Created Tasks:
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#task-created">
                        <div class="accordion-body">
                            @if (isset($tasks))
                                @foreach ($tasks as $task)
                                    <a href="{{ url('mob/task/edit') }}/{{ $task->id }}" class="text-reset">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="text-center p-1">
                                                    <div class="avatar-sm mx-auto mb-3 mt-1">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                            {{ $task->id }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="p-4 text-center ">
                                                    <span class="text-truncate pb-1">{{ $task->task_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="alert alert-warning">No Task Created</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create New Task</h4>
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
                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">
                                <div class="form-group row mb-4">
                                    <label for="task_name" class="col-form-label col-lg-2">Task Name</label>
                                    <div class="col-lg-10">
                                        <input id="task_name" name="task_name" type="text" class="form-control"
                                            placeholder="Task Name">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="remarks" class="col-form-label col-lg-2">Task Description</label>
                                    <div class="col-lg-10">
                                        <textarea name="area" id="remarks"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label col-lg-2">Team</label>
                                    <div class="col-lg-10">
                                        <select id="team_id" name="team_id" class="form-control select2">
                                            <option>Select</option>
                                            @if (isset($team))
                                                <option value="{{ $team->team_id }}">{{ $team->team_name }}
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label col-lg-2">Add Team Member</label>
                                    <div class="col-lg-10">
                                        <select name="members[]" class="select2 form-control select2-multiple"
                                            multiple="multiple" data-placeholder="Choose ...">
                                            @if (isset($members) && count($members) > 0)
                                                @foreach ($members as $m)
                                                    <option value="{{ $m->user_id }}">{{ $m->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label col-lg-2">Status</label>
                                    <div class="col-lg-10">
                                        <select id="task_status" name="task_status" class="form-control select2">
                                            <option>Select</option>
                                            @if (isset($task_status) && count($task_status) > 0)
                                                @foreach ($task_status as $status)
                                                    <option value="{{ $status->lov_code }}">{{ $status->lov_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="start_time" class="col-form-label col-lg-2">Start Time</label>
                                    <div class="col-lg-10">
                                        <input name="start_time" class="form-control" type="datetime-local"
                                            placeholder="Start Time" id="start_time">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="end_time" class="col-form-label col-lg-2">End Time</label>
                                    <div class="col-lg-10">
                                        <input name="end_time" class="form-control" type="datetime-local"
                                            placeholder="End Time" id="end_time">
                                    </div>
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
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/task-create.init.js') }}"></script>
    <script type="text/javascript">
        $(".select2").select2();

        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

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
        });

        0 < $("#remarks").length && tinymce.init({
            selector: "textarea#remarks",
            height: 200,
            plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [{
                title: "Bold text",
                inline: "b"
            }, {
                title: "Red text",
                inline: "span",
                styles: {
                    color: "#ff0000"
                }
            }, {
                title: "Red header",
                block: "h1",
                styles: {
                    color: "#ff0000"
                }
            }, {
                title: "Example 1",
                inline: "span",
                classes: "example1"
            }, {
                title: "Example 2",
                inline: "span",
                classes: "example2"
            }, {
                title: "Table styles"
            }, {
                title: "Table row 1",
                selector: "tr",
                classes: "tablerow1"
            }]
        });
    </script>
@endsection
