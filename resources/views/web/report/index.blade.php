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
                                <option value="">Select</option>
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
                                        <th rowspan="3">MONTH</th>
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
                                        <?php
                                        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                                        $month_once = 0;
                                        $GTtotSaleNasty = 0;
                                        $GTtotSaleAkso = 0;
                                        $GTtotUnitSaleNasty = 0;
                                        $GTtotUnitSaleAkso = 0;
                                        $GTtotUnitKTZroxNasty = 0;
                                        $GTtotUnitKTZroxAkso = 0;
                                        $GTtotPriceKTZroxNasty = 0;
                                        $GTtotPriceKTZroxAkso = 0;
                                        $GTtotUnitKMBvrNasty = 0;
                                        $GTtotUnitKMBvrAkso = 0;
                                        $GTtotPriceKMBvrNasty = 0;
                                        $GTtotPriceKMBvrAkso = 0;
                                        $GTtotUnitBSTtNasty = 0;
                                        $GTtotUnitBSTtAkso = 0;
                                        $GTtotPriceBSTtNasty = 0;
                                        $GTtotPriceBSTtAkso = 0;
                                        $GTtotUnitDGSdNasty = 0;
                                        $GTtotUnitDGSdAkso = 0;
                                        $GTtotPriceDGSdNasty = 0;
                                        $GTtotPriceDGSdAkso = 0;
                                        $GTtotUnitVSTStNasty = 0;
                                        $GTtotUnitVSTStAkso = 0;
                                        $GTtotPriceVSTStNasty = 0;
                                        $GTtotPriceVSTStAkso = 0;
                                        ?>

                                        @foreach ($months as $m)
                                            <?php
                                            $isFound = false;
                                            $totSaleNasty = 0;
                                            $totSaleAkso = 0;
                                            $totUnitSaleNasty = 0;
                                            $totUnitSaleAkso = 0;
                                            $totUnitKTZroxNasty = 0;
                                            $totUnitKTZroxAkso = 0;
                                            $totPriceKTZroxNasty = 0;
                                            $totPriceKTZroxAkso = 0;
                                            $totUnitKMBvrNasty = 0;
                                            $totUnitKMBvrAkso = 0;
                                            $totPriceKMBvrNasty = 0;
                                            $totPriceKMBvrAkso = 0;
                                            $totUnitBSTtNasty = 0;
                                            $totUnitBSTtAkso = 0;
                                            $totPriceBSTtNasty = 0;
                                            $totPriceBSTtAkso = 0;
                                            $totUnitDGSdNasty = 0;
                                            $totUnitDGSdAkso = 0;
                                            $totPriceDGSdNasty = 0;
                                            $totPriceDGSdAkso = 0;
                                            $totUnitVSTStNasty = 0;
                                            $totUnitVSTStAkso = 0;
                                            $totPriceVSTStNasty = 0;
                                            $totPriceVSTStAkso = 0;

                                            ?>
                                            @foreach ($response as $res)
                                                @if ($m === $res->imonth)
                                                    <?php $month_once++; $isFound = true; ?>
                                                    <tr>
                                                        <td style="background-color:rgb(49, 46, 236);color:aliceblue;">
                                                            {{ $month_once === 1 ? $res->imonth : '' }}</td>
                                                        <td>{{ $res->iday }}</td>
                                                        <td>{{ $res->idate }}</td>
                                                        <td>{{ number_format($res->d_tot_sale_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_sale_akso, 2) }}</td>
                                                        <td>{{ $res->d_tot_unit_sale_nasty }}</td>
                                                        <td>{{ $res->d_tot_unit_sale_akso }}</td>
                                                        <td>{{ $res->d_tot_unit_kt_zrox_nasty }}</td>
                                                        <td>{{ $res->d_tot_unit_kt_zrox_akso }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_kt_zrox_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_kt_zrox_akso, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_kt_zrox_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_kt_zrox_akso, 2) }}</td>
                                                        <td></td>
                                                        <td>{{ $res->d_tot_unit_kmm_bvr_nasty }}</td>
                                                        <td>{{ $res->d_tot_unit_kmm_bvr_akso }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_kmm_bvr_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_kmm_bvr_akso, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_kmm_bvr_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_kmm_bvr_akso, 2) }}</td>
                                                        <td></td>
                                                        <td>{{ $res->d_tot_unit_bs_tt_nasty }}</td>
                                                        <td>{{ $res->d_tot_unit_bs_tt_akso }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_bs_tt_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_bs_tt_akso, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_bs_tt_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_bs_tt_akso, 2) }}</td>
                                                        <td></td>
                                                        <td>{{ $res->d_tot_unit_dg_sd_nasty }}</td>
                                                        <td>{{ $res->d_tot_unit_dg_sd_akso }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_dg_sd_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_dg_sd_akso, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_dg_sd_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_dg_sd_akso, 2) }}</td>
                                                        <td></td>
                                                        <td>{{ $res->d_tot_unit_vst_st_nasty }}</td>
                                                        <td>{{ $res->d_tot_unit_vst_st_akso }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_vst_st_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_prcp_unit_vst_st_akso, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_vst_st_nasty, 2) }}</td>
                                                        <td>{{ number_format($res->d_tot_price_vst_st_akso, 2) }}</td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                    $month_once = 0;
                                                    $totSaleNasty += $res->d_tot_sale_nasty;
                                                    $totSaleAkso += $res->d_tot_sale_akso;
                                                    $totUnitSaleNasty += $res->d_tot_unit_sale_nasty;
                                                    $totUnitSaleAkso += $res->d_tot_unit_sale_akso;
                                                    $totUnitKTZroxNasty += $res->d_tot_unit_kt_zrox_nasty;
                                                    $totUnitKTZroxAkso += $res->d_tot_unit_kt_zrox_akso;
                                                    $totPriceKTZroxNasty += $res->d_tot_price_kt_zrox_nasty;
                                                    $totPriceKTZroxAkso += $res->d_tot_price_kt_zrox_nasty;
                                                    $totUnitKMBvrNasty += $res->d_tot_unit_kmm_bvr_nasty;
                                                    $totUnitKMBvrAkso += $res->d_tot_unit_kmm_bvr_akso;
                                                    $totPriceKMBvrNasty += $res->d_tot_price_kmm_bvr_nasty;
                                                    $totPriceKMBvrAkso += $res->d_tot_price_kmm_bvr_akso;
                                                    $totUnitBSTtNasty += $res->d_tot_unit_bs_tt_nasty;
                                                    $totUnitBSTtAkso += $res->d_tot_unit_bs_tt_akso;
                                                    $totPriceBSTtNasty += $res->d_tot_price_bs_tt_nasty;
                                                    $totPriceBSTtAkso += $res->d_tot_price_bs_tt_akso;
                                                    $totUnitDGSdNasty += $res->d_tot_unit_dg_sd_nasty;
                                                    $totUnitDGSdAkso += $res->d_tot_unit_dg_sd_akso;
                                                    $totPriceDGSdNasty += $res->d_tot_price_dg_sd_nasty;
                                                    $totPriceDGSdAkso += $res->d_tot_price_dg_sd_akso;
                                                    $totUnitVSTStNasty += $res->d_tot_unit_vst_st_nasty;
                                                    $totUnitVSTStAkso += $res->d_tot_unit_vst_st_akso;
                                                    $totPriceVSTStNasty += $res->d_tot_price_vst_st_nasty;
                                                    $totPriceVSTStAkso += $res->d_tot_price_vst_st_akso;
                                                    ?>
                                                @endif
                                            @endforeach
                                            @if ($isFound)
                                                <tr style="background-color:rgb(234, 243, 232);color:rgb(12, 12, 12);">
                                                    <td>Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ number_format($totSaleNasty, 2) }}</td>
                                                    <td>{{ number_format($totSaleAkso, 2) }}</td>
                                                    <td>{{ $totUnitSaleNasty }}</td>
                                                    <td>{{ $totUnitSaleAkso }}</td>
                                                    <td>{{ $totUnitKTZroxNasty }}</td>
                                                    <td>{{ $totUnitKTZroxAkso }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ number_format($totPriceKTZroxNasty, 2) }}</td>
                                                    <td>{{ number_format($totPriceKTZroxAkso, 2) }}</td>
                                                    <td></td>
                                                    <td>{{ $totUnitKMBvrNasty }}</td>
                                                    <td>{{ $totUnitKMBvrAkso }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ number_format($totPriceKMBvrNasty, 2) }}</td>
                                                    <td>{{ number_format($totPriceKMBvrAkso, 2) }}</td>
                                                    <td></td>
                                                    <td>{{ $totUnitBSTtNasty }}</td>
                                                    <td>{{ $totUnitBSTtAkso }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ number_format($totPriceBSTtNasty, 2) }}</td>
                                                    <td>{{ number_format($totPriceBSTtAkso, 2) }}</td>
                                                    <td></td>
                                                    <td>{{ $totUnitDGSdNasty }}</td>
                                                    <td>{{ $totUnitDGSdAkso }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ number_format($totPriceDGSdNasty, 2) }}</td>
                                                    <td>{{ number_format($totPriceDGSdAkso, 2) }}</td>
                                                    <td></td>
                                                    <td>{{ $totUnitVSTStNasty }}</td>
                                                    <td>{{ $totUnitVSTStAkso }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ number_format($totPriceVSTStNasty, 2) }}</td>
                                                    <td>{{ number_format($totPriceVSTStAkso, 2) }}</td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            <?php
                                            $GTtotSaleNasty += $totSaleNasty;
                                            $GTtotSaleAkso += $totSaleAkso;
                                            $GTtotUnitSaleNasty += $totUnitSaleNasty;
                                            $GTtotUnitSaleAkso += $totUnitSaleAkso;
                                            $GTtotUnitKTZroxNasty += $totUnitKTZroxNasty;
                                            $GTtotUnitKTZroxAkso += $totUnitKTZroxAkso;
                                            $GTtotPriceKTZroxNasty += $totPriceKTZroxNasty;
                                            $GTtotPriceKTZroxAkso += $totPriceKTZroxAkso;
                                            $GTtotUnitKMBvrNasty += $totUnitKMBvrNasty;
                                            $GTtotUnitKMBvrAkso += $totUnitKMBvrAkso;
                                            $GTtotPriceKMBvrNasty += $totPriceKMBvrNasty;
                                            $GTtotPriceKMBvrAkso += $totPriceKMBvrAkso;
                                            $GTtotUnitBSTtNasty += $totUnitBSTtNasty;
                                            $GTtotUnitBSTtAkso += $totUnitBSTtAkso;
                                            $GTtotPriceBSTtNasty += $totPriceBSTtNasty;
                                            $GTtotPriceBSTtAkso += $totPriceBSTtAkso;
                                            $GTtotUnitDGSdNasty += $totUnitDGSdNasty;
                                            $GTtotUnitDGSdAkso += $totUnitDGSdAkso;
                                            $GTtotPriceDGSdNasty += $totPriceDGSdNasty;
                                            $GTtotPriceDGSdAkso += $totPriceDGSdAkso;
                                            $GTtotUnitVSTStNasty += $totUnitVSTStNasty;
                                            $GTtotUnitVSTStAkso += $totUnitVSTStAkso;
                                            $GTtotPriceVSTStNasty += $totPriceVSTStNasty;
                                            $GTtotPriceVSTStAkso += $totPriceVSTStAkso;
                                            ?>
                                        @endforeach
                                        <tr style="background-color:rgb(49, 46, 236);color:aliceblue;">
                                            <td>Grand Total</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ number_format($GTtotSaleNasty, 2) }}</td>
                                            <td>{{ number_format($GTtotSaleAkso, 2) }}</td>
                                            <td>{{ $GTtotUnitSaleNasty }}</td>
                                            <td>{{ $GTtotUnitSaleAkso }}</td>
                                            <td>{{ $GTtotUnitKTZroxNasty }}</td>
                                            <td>{{ $GTtotUnitKTZroxAkso }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ number_format($GTtotPriceKTZroxNasty, 2) }}</td>
                                            <td>{{ number_format($GTtotPriceKTZroxAkso, 2) }}</td>
                                            <td></td>
                                            <td>{{ $GTtotUnitKMBvrNasty }}</td>
                                            <td>{{ $GTtotUnitKMBvrAkso }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ number_format($GTtotPriceKMBvrNasty, 2) }}</td>
                                            <td>{{ number_format($GTtotPriceKMBvrAkso, 2) }}</td>
                                            <td></td>
                                            <td>{{ $GTtotUnitBSTtNasty }}</td>
                                            <td>{{ $GTtotUnitBSTtAkso }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ number_format($GTtotPriceBSTtNasty, 2) }}</td>
                                            <td>{{ number_format($GTtotPriceBSTtAkso, 2) }}</td>
                                            <td></td>
                                            <td>{{ $GTtotUnitDGSdNasty }}</td>
                                            <td>{{ $GTtotUnitDGSdAkso }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ number_format($GTtotPriceDGSdNasty, 2) }}</td>
                                            <td>{{ number_format($GTtotPriceDGSdAkso, 2) }}</td>
                                            <td></td>
                                            <td>{{ $GTtotUnitVSTStNasty }}</td>
                                            <td>{{ $GTtotUnitVSTStAkso }}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ number_format($GTtotPriceVSTStNasty, 2) }}</td>
                                            <td>{{ number_format($GTtotPriceVSTStAkso, 2) }}</td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </tbody>
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
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script type="text/javascript">
        $(".select2").select2();

        $('#export_report').on('click', function() {
            $('#downloadform').submit();
        });

        var rtbl = $('#reportTable');

        var settings = {
            pageLength: 31,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                action: function(e, dt, node, config) {
                    ExportToExcel('xlsx');
                }
            }]
        }

        $('#reportTable').DataTable(settings);

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('reportTable');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "Consignment_Report"
            });

            var today = new Date();
            var date = today.getFullYear() + '' + (today.getMonth() + 1) + '' + today.getDate();
            var time = today.getHours() + "" + today.getMinutes() + "" + today.getSeconds();
            var dateTime = date + 'T' + time;

            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('Consignment_Report_' + dateTime + '.' + (type || 'xlsx')));
        }
    </script>
@endsection
