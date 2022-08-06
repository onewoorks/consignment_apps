@extends('layouts.web.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
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
                    <div class="form-group row mb-4">
                        <div class="table-responsive">
                            <table id="reportTable" class="table table-sm table-bordered" cellspacing="0"
                                style="width:100%">
                                <thead class="text-center" style="background:grey; color:aliceblue;">
                                    <tr>
                                        <th rowspan="3">DAY</th>
                                        <th rowspan="3">DATE</th>
                                        <th rowspan="3">Daily Total RM Sale Nasty</th>
                                        <th rowspan="3">Daily Total RM Sale AKSO</th>
                                        <th rowspan="3">Daily Total RM Unit Nasty</th>
                                        <th rowspan="3">Daily Total RM Unit AKSO</th>
                                        <th colspan="7">ZROW</th>
                                        <th colspan="7">BVR</th>
                                        <th colspan="7">TWENTY TWO</th>
                                        <th colspan="7">SUDENG</th>
                                        <th colspan="7">STERN</th>
                                    </tr>
                                    <tr>
                                        <th colspan="6">Kuala Terengganu</th>
                                        <th rowspan="2">Payment</th>
                                        <th colspan="6">Kemaman</th>
                                        <th rowspan="2">Payment</th>
                                        <th colspan="6">Besut/Setiu</th>
                                        <th rowspan="2">Payment</th>
                                        <th colspan="6">Dungun</th>
                                        <th rowspan="2">Payment</th>
                                        <th colspan="6">Vape Shop Terengganu</th>
                                        <th rowspan="2">Payment</th>
                                    </tr>
                                    <tr>
                                        <th>NFIX</th>
                                        <th>AKSO</th>
                                        <th>RM (NFIX)</th>
                                        <th>RM (AKSO)</th>
                                        <th>TOTAL (NFIX)</th>
                                        <th>TOTAL (AKSO)</th>
                                        <th>NFIX</th>
                                        <th>AKSO</th>
                                        <th>RM (NFIX)</th>
                                        <th>RM (AKSO)</th>
                                        <th>TOTAL (NFIX)</th>
                                        <th>TOTAL (AKSO)</th>
                                        <th>NFIX</th>
                                        <th>AKSO</th>
                                        <th>RM (NFIX)</th>
                                        <th>RM (AKSO)</th>
                                        <th>TOTAL (NFIX)</th>
                                        <th>TOTAL (AKSO)</th>
                                        <th>NFIX</th>
                                        <th>AKSO</th>
                                        <th>RM (NFIX)</th>
                                        <th>RM (AKSO)</th>
                                        <th>TOTAL (NFIX)</th>
                                        <th>TOTAL (AKSO)</th>
                                        <th>NFIX</th>
                                        <th>AKSO</th>
                                        <th>RM (NFIX)</th>
                                        <th>RM (AKSO)</th>
                                        <th>TOTAL (NFIX)</th>
                                        <th>TOTAL (AKSO)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($response) && count($response) > 0)
                                        @foreach ($response as $res)
                                            <tr>
                                                <td>{{ $res->iday }}</td>
                                                <td>{{ $res->idate }}</td>
                                                <td>{{ $res->d_tot_sale_nasty }}</td>
                                                <td>{{ $res->d_tot_sale_akso }}</td>
                                                <td>{{ $res->d_tot_unit_sale_nasty }}</td>
                                                <td>{{ $res->d_tot_unit_sale_akso }}</td>
                                                <td>{{ $res->d_tot_unit_kt_zrox_nasty }}</td>
                                                <td>{{ $res->d_tot_unit_kt_zrox_akso }}</td>
                                                <td>{{ $res->d_prcp_unit_kt_zrox_nasty }}</td>
                                                <td>{{ $res->d_prcp_unit_kt_zrox_akso }}</td>
                                                <td>{{ $res->d_tot_price_kt_zrox_nasty }}</td>
                                                <td>{{ $res->d_tot_price_kt_zrox_akso }}</td>
                                                <td></td>
                                                <td>{{ $res->d_tot_unit_kmm_bvr_nasty }}</td>
                                                <td>{{ $res->d_tot_unit_kmm_bvr_akso }}</td>
                                                <td>{{ $res->d_prcp_unit_kmm_bvr_nasty }}</td>
                                                <td>{{ $res->d_prcp_unit_kmm_bvr_akso }}</td>
                                                <td>{{ $res->d_tot_price_kmm_bvr_nasty }}</td>
                                                <td>{{ $res->d_tot_price_kmm_bvr_akso }}</td>
                                                <td></td>
                                                <td>{{ $res->d_tot_unit_bs_tt_nasty }}</td>
                                                <td>{{ $res->d_tot_unit_bs_tt_akso }}</td>
                                                <td>{{ $res->d_prcp_unit_bs_tt_nasty }}</td>
                                                <td>{{ $res->d_prcp_unit_bs_tt_akso }}</td>
                                                <td>{{ $res->d_tot_price_bs_tt_nasty }}</td>
                                                <td>{{ $res->d_tot_price_bs_tt_akso }}</td>
                                                <td></td>
                                                <td>{{ $res->d_tot_unit_dg_sd_nasty }}</td>
                                                <td>{{ $res->d_tot_unit_dg_sd_akso }}</td>
                                                <td>{{ $res->d_prcp_unit_dg_sd_nasty }}</td>
                                                <td>{{ $res->d_prcp_unit_dg_sd_akso }}</td>
                                                <td>{{ $res->d_tot_price_dg_sd_nasty }}</td>
                                                <td>{{ $res->d_tot_price_dg_sd_akso }}</td>
                                                <td></td>
                                                <td>{{ $res->d_tot_unit_vst_st_nasty }}</td>
                                                <td>{{ $res->d_tot_unit_vst_st_akso }}</td>
                                                <td>{{ $res->d_prcp_unit_vst_st_nasty }}</td>
                                                <td>{{ $res->d_prcp_unit_vst_st_akso }}</td>
                                                <td>{{ $res->d_tot_price_vst_st_nasty }}</td>
                                                <td>{{ $res->d_tot_price_vst_st_akso }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                            </table>
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
                    <button id="export_report" type="button" class="btn btn-primary btn-block">Generate</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(".select2").select2();

        $('#export_report').on('click', function() {
            $('#downloadform').submit();
        });

        var rtbl = $('#reportTable');

        var settings = {
            pageLength: 31,
            dom: 'Bfrtip',
            buttons: {
                buttons: [{
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible',
                            autoPrint: false,
                            orientation: 'landscape'
                        }
                    },
                    {
                        extend: 'excel'
                    },
                    {
                        extend: 'pdf',
                        text: 'Export PDF',
                        orientation: 'landscape',
                        customize: function(doc) {
                            var colCount = new Array();
                            $(rtbl).find('tbody tr:first-child td').each(function() {
                                if ($(this).attr('colspan')) {
                                    for (var i = 1; i <= $(this).attr('colspan'); i++) {
                                        colCount.push('*');
                                    }
                                } else {
                                    colCount.push('*');
                                }
                            });
                            doc.content[1].table.widths = colCount;
                        }
                    }
                ]
            }
        }

        $('#reportTable').DataTable(settings);
    </script>
@endsection
