@extends('layouts.mob.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Report
        @endslot
    @endcomponent

    <div class="row">
        <div class="card">
            <div class="card-body">
                <form id="downloadform" method="get" action="{{ url('mob/report/export') }}/{{ Auth::user()->name }}">
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-lg-2">Year</label>
                        <div class="col-lg-10">
                            <select id="reportyear" name="reportyear" class="form-control select2">
                                @if (isset($years) && count($years) > 0)
                                    @foreach ($years as $y)
                                        <option value="{{ $y }}" @if($y === Carbon\Carbon::now()) selected @endif>{{ $y }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row g-0 fixed-footer">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-grid mt-2">
                    <button id="export_report" type="button" class="btn btn-primary btn-block">Download</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(".select2").select2();

        $('#export_report').on('click', function() {
            $('#downloadform').submit();
        });
    </script>
@endsection
