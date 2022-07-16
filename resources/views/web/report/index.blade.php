@extends('layouts.web.master')

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
                <form id="downloadform" method="get" action="{{ url('web/report/export') }}">
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-lg-2">Month</label>
                        <div class="col-lg-10">
                            <select id="reportmonth" name="reportmonth" class="form-control select2">
                                @if (isset($months) && count($months) > 0)
                                    @foreach ($months as $m)
                                        <option value="{{ $m->key }}"
                                            @if ($m->key === Carbon\Carbon::now()->month) selected @endif>{{ $m->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label col-lg-2">Year</label>
                        <div class="col-lg-10">
                            <select id="reportyear" name="reportyear" class="form-control select2">
                                @if (isset($years) && count($years) > 0)
                                    @foreach ($years as $y)
                                        <option value="{{ $y }}"
                                            @if ($y === Carbon\Carbon::now()->year) selected @endif>{{ $y }}
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
    <div class="row ">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-grid">
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
