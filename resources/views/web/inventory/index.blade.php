@extends('layouts.web.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Inventory
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <h4 class="card-title">Inventory</h4>
                        <p class="card-title-desc">Please input the criteria</p>
                        <form id="form-inventory" method="post" action="{{ url('/web/inventory') }}">
                            {{ csrf_field() }}
                            <input id="channel" name="channel" type="hidden" value="web" />
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="shop_id">Shop Name</label>
                                        <select id="shop_id" name="shop_id" class="form-control select2">
                                            <option value="">Select</option>
                                            @if (isset($shops) && count($shops) > 0)
                                                @foreach ($shops as $shop)
                                                    <option value="{{ $shop->id }}">
                                                        {{ $shop->shop_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label>Inventory Date</label>
                                        <div class="input-group" id="datepicker2">
                                            <input id="inventorydt" name="inventorydt" type="text" class="form-control"
                                                placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd"
                                                data-date-container='#datepicker2' data-provide="datepicker"
                                                data-date-autoclose="true">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-wrap gap-2">
                                                <button type="submit" id="save-inventory"
                                                    class="btn btn-primary waves-effect waves-light">Search</button>
                                                <button type="reset" id="reset-inventory"
                                                    class="btn btn-secondary waves-effect waves-light">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="inventorytable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th style="text-align:center;">Branch Name</th>
                                    <th style="text-align:center;">Shop</th>
                                    <th style="text-align:center;">Product</th>
                                    <th style="text-align:center;">Stock Flow</th>
                                    <th style="text-align:center;">Total Unit</th>
                                    <th style="text-align:center;">Price Per Unit (RM)</th>
                                    <th style="text-align:center;">Total Price (RM)</th>
                                    <th style="text-align:center;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($inventories) && count($inventories) > 0)
                                    @foreach ($inventories as $i)
                                        <tr>
                                            <td style="text-align:center;">{{ $i->region }}</td>
                                            <td style="text-align:left;">{{ $i->shop_name }}</td>
                                            <td style="text-align:left;">{{ $i->product_code }} -
                                                {{ $i->product_name }}</td>
                                            <td style="text-align:center;">{{ $i->stock_flow }}</td>
                                            <td style="text-align:center;">{{ $i->quantity }}</td>
                                            <td style="text-align:right;">{{ number_format($i->price_per_unit, 2) }}</td>
                                            <td style="text-align:right;">{{ number_format($i->total_price, 2) }}</td>
                                            <td style="text-align:center;">{{ $i->created_at }}</td>
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
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript">
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#inventorydt').datepicker('setDate', today);

        $("#inventorytable").DataTable();
    </script>
@endsection
