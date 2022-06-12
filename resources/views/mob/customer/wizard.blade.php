@extends('layouts.mob.master')

@section('title')
    @lang('translation.RegisterNewCustomer')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('/assets/css/mob/customer-wizard.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    {{-- <div class="container d-flex align-items-center min-vh-50"> --}}
    <div class="row g-0 justify-content-center">
        <!-- TITLE -->
        <div class="col-lg-4 offset-lg-1 mx-0 px-0">
            <div id="title-container">
                <img class="shop-image rounded-circle" src="{{ asset($customer->shop_image) }}">
                <h2>{{ $customer->shop_name }}</h2>
                <h3>Region: {{ $customer->region }}</h3>
                <h3>{{ $customer->owner }} - {{ $customer->phone_number }}</h3>
                <p>{{ $customer->address }}</p>
            </div>
        </div>
        <!-- FORMS -->
        <div class="col-lg-7 mx-0 px-0">
            <div class="progress">
                <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50"
                    class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"
                    style="width: 0%"></div>
            </div>
            <div id="qbox-container">
                {{-- <form class="needs-validation" id="form-wrapper" method="post" name="form-wrapper" novalidate=""> --}}
                <div id="steps-container">
                    <div class="step">
                        <h4>Available Stocks:</h4>
                        <div class="accordion" id="add-stock">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Add New Stock
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                    data-bs-parent="#add-stock">
                                    <div class="accordion-body">
                                        <!-- end accordion -->
                                        <h4 class="card-title">Stock</h4>
                                        <p class="card-title-desc">Fill all information below</p>
                                        <form id="form-stock" method="post" action="{{ url('/mob/catalog/add') }}">
                                            {{ csrf_field() }}
                                            <input id="shop_id" name="shop_id" type="hidden" value={{ $customer->id }}>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="product_code">Product Code</label>
                                                        <select id="product_code" name="product_code"
                                                            class="form-control select2">
                                                            <option>Select</option>
                                                            @if (isset($products) && count($products) > 0)
                                                                @foreach ($products as $prod)
                                                                    <option value="{{ $prod->product_code }}">
                                                                        {{ $prod->product_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="quantity" class="form-label">Quantity:</label>
                                                        <input id="quantity" name="quantity" data-toggle="touchspin"
                                                            type="text" value="0" class="form-control consignment-tspin">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="price_per_unit">Price Per Unit:</label>
                                                        <input data-toggle="touchspin" id="price_per_unit"
                                                            name="price_per_unit" type="text" value="0.00"
                                                            class="form-control consignment-tspin" data-bts-prefix="RM">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="d-flex flex-wrap gap-2">
                                                                <button type="submit" id="save-stock"
                                                                    class="btn btn-primary waves-effect waves-light">Add
                                                                    Stock</button>
                                                                <button type="reset" id="reset-stock"
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
                        <hr />
                        @if (isset($customer->catalogs))
                            @foreach ($customer->catalogs as $catalog)
                                <div class="card mini-stats-wid" class="row">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="avatar-sm mx-auto mb-3 mt-1">
                                                            <span
                                                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                                {{ $catalog->product_code }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="text-center mx-auto mb-3 mt-3">
                                                            <h5>
                                                                {{ $catalog->product->product_name }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="text-center">
                                                    <p class="text-muted mb-2 text-truncate">Total Consigned</p>
                                                    <h5>{{ $catalog->available_stock }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="text-center">
                                                    <p class="text-muted mb-2 text-truncate">Price Per Unit (RM)
                                                    </p>
                                                    <h5>{{ $catalog->price_per_unit }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="step">
                        <h4>Stock Out:</h4>
                        @if (isset($customer->catalogs))
                            @foreach ($customer->catalogs as $catalog)
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                                    {{ $catalog->product_code }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-center mx-auto mb-3 mt-3">
                                                                <h5>
                                                                    {{ $catalog->product->product_name }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-center mx-auto mb-3 mt-3">
                                                        <input id="qty_stock_out" name="qty_stock_out[]"
                                                            data-catalog="{{ $catalog }}" data-toggle="touchspin"
                                                            data-region="{{ $customer->region }}" type="text" value="0"
                                                            class="form-control consignment-tspin">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="step">
                        <h4>Stock In:</h4>
                        @if (isset($customer->catalogs))
                            @foreach ($customer->catalogs as $catalog)
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                                    {{ $catalog->product_code }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="text-center mx-auto mb-3 mt-3">
                                                                <h5>
                                                                    {{ $catalog->product->product_name }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="text-center mx-auto mb-3 mt-3">
                                                        <input id="qty_stock_in" name="qty_stock_in[]"
                                                            data-catalog="{{ $catalog }}" data-toggle="touchspin"
                                                            data-region="{{ $customer->region }}" type="text" value="0"
                                                            class="form-control consignment-tspin">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="step">
                        <h4>Verify Stock In/Out:</h4>
                        @if (isset($customer->catalogs))
                            <hr />
                            @foreach ($customer->catalogs as $catalog)
                                <div id="{{ $catalog->id }}" data-catalog={{ $catalog }} class="row list-product">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-3 text-center p-1">
                                                            <div class="avatar-sm mx-auto mb-3 mt-1">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                                    {{ $catalog->product_code }}
                                                                </span>
                                                            </div>
                                                            <h5 class="text-truncate pb-1">
                                                                {{ $catalog->product->product_name }}</h5>
                                                        </div>
                                                        <div class="col-sm-6 text-center mx-auto mb-3 mt-3">
                                                            <p class="text-muted mb-2 text-truncate">Total New Consigned
                                                            </p>
                                                            <h5>
                                                                <div data-initialstock="{{ $catalog->available_stock }}"
                                                                    id="total_consigned_{{ $loop->index }}"
                                                                    class='total-consigned'>
                                                                    {{ $catalog->available_stock }}</div>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row text-center">
                                                        <div class="col-3"></div>
                                                        <div class="col-3 text-center">
                                                            <div class="mx-auto mb-3 mt-3">
                                                                <div id="new_stock_in_{{ $loop->index }}"
                                                                    class="btn btn-success btn-lg action-add"
                                                                    name="new_stock_in[]">
                                                                    0
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 text-center">
                                                            <div class="mx-auto mb-3 mt-3">
                                                                <div id="new_stock_out_{{ $loop->index }}"
                                                                    class="btn btn-danger btn-lg action-remove"
                                                                    name="new_stock_out[]">0
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="step">
                        <div class="mt-1">
                            <div class="closing-text">
                                <h4>Confirmation!</h4>
                                <p>If you have done maintained the stock.</p>
                                <p>Click on the submit button to continue.</p>
                            </div>
                        </div>
                    </div>
                    <div id="success">
                        <div class="mt-5">
                            <h4>Success! Your stock successfully submitted!</h4>
                            <p>Thank you!</p>
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-grid mt-2">
                                        <div class="btn btn-primary btn-block" id='print_consignment'>Print Consigment Note
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <a class="back-link" href="{{ url('/mob/task/details/') }}/{{ $task->id }}">Go
                                back
                                from the beginning ➜</a>
                        </div>
                    </div>
                </div>
                <div id="q-box__buttons">
                    <button id="prev-btn" type="button">Previous</button>
                    <button id="next-btn" type="button">Next</button>
                    <button id="submit-btn" type="button">Submit</button>
                </div>
                {{-- </form> --}}
            </div>
        </div>
        <input type="hidden" name="taskid" id="taskid" value="{{ $task->id }}" />
        <input type="hidden" name="custid" id="custid" value="{{ $customer->id }}" />
    </div>
    {{-- </div> --}}
    <div id="preloader-wrapper">
        <div id="preloader"></div>
        <div class="preloader-section section-left"></div>
        <div class="preloader-section section-right"></div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/mob/customer-wizard.js') }}"></script>
    <script type="text/javascript">
        $("input[name='quantity']").TouchSpin({
            verticalbuttons: 0,
            buttondown_class: "btn btn-success",
            buttonup_class: "btn btn-success"
        });
        $("input[name='price_per_unit']").TouchSpin({
            verticalbuttons: 0,
            decimals: 2,
            step: 0.01
        });
        $("input[name='qty_stock_in[]']").TouchSpin({
            verticalbuttons: 0,
            buttondown_class: "btn btn-success",
            buttonup_class: "btn btn-success"
        });
        $("input[name='qty_stock_out[]']").TouchSpin({
            verticalbuttons: 0,
            buttondown_class: "btn btn-danger",
            buttonup_class: "btn btn-danger"
        });
    </script>
@endsection
