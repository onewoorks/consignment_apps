@extends('layouts.mob.master')

@section('title')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
@endsection

@section('content')
    <div class="row">
        <div class="row g-0">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="accordion" id="add-stock">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Filter Inventory
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                                <div class="accordion-body">
                                    <h4 class="card-title">Inventory</h4>
                                    <p class="card-title-desc">Please input the criteria</p>
                                    <form id="form-inventory" method="post" action="{{ url('/mob/inventory') }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label for="shop_id">Shop Name</label>
                                                    <select id="shop_id" name="shop_id" class="form-control select2">
                                                        <option>Select</option>
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
                                                        <input id="inventorydt" name="inventorydt" type="text"
                                                            class="form-control" placeholder="yyyy-mm-dd"
                                                            data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                                            data-provide="datepicker" data-date-autoclose="true">
                                                        <span class="input-group-text"><i
                                                                class="mdi mdi-calendar"></i></span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0 inventory-list">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    @if (isset($inventories))
                        @foreach ($inventories as $i)
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="text-center p-1">
                                        <h5 class="text-truncate pb-1">Shop Name: {{ $i->shop_name }}</h5>
                                        <div>Region: {{ $i->region }}</div>
                                        <div>Product Code: {{ $i->product_code }}</div>
                                        <div>Product Name: {{ $i->product_name }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="text-center p-1">
                                        <div>Stock Flow: {{ $i->stock_flow }}</div>
                                        <div>Quantity: {{ $i->quantity }}</div>
                                        <div>Price Per Unit: {{ $i->price_per_unit }}</div>
                                        <div>Total Price: {{ $i->total_price }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="text-center p-1">
                                        <div>Created By: {{ $i->created_by }}</div>
                                        <div>Created At: {{ $i->created_at }}</div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#inventorydt').datepicker('setDate', today);
    </script>
@endsection
