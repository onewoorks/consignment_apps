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
                <img class="covid-image" src="{{ asset($customer->shop_image) }}">
                <h2>{{ $customer->shop_name }}</h2>
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
                                                            name="price_per_unit" type="text" value="0.00" class="form-control consignment-tspin"
                                                            data-bts-prefix="RM">
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
                                <div id="product-{{ $catalog->id }}" class="row list-product">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-8">
                                                    <form>
                                                    <div>{{ $catalog->product_code }} -
                                                        {{ $catalog->product->product_name }}</div>
                                                    <div class='total-consigned'>Quantity:
                                                        {{ $catalog->available_stock }} Price Per Unit (RM):
                                                        {{ $catalog->price_per_unit }}
                                                    </div>
                                                    </form>
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
                                <div id="product-{{ $catalog->id }}" class="row list-product">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div>{{ $catalog->product_code }} -
                                                        {{ $catalog->product->product_name }}</div>
                                                    <div class='total-consigned'>{{ $catalog->available_stock }}</div>

                                                </div>
                                                <div class="col-sm-4">
                                                    <input id="qty_stock_out" name="qty_stock_out" data-toggle="touchspin"
                                                        type="text" value="0" class="form-control consignment-tspin">
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
                                <div id="product-{{ $catalog->id }}" class="row list-product">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div>{{ $catalog->product_code }} -
                                                        {{ $catalog->product->product_name }}</div>
                                                    <div class='total-consigned'>{{ $catalog->available_stock }}</div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input id="qty_stock_in" name="qty_stock_in" data-toggle="touchspin"
                                                        type="text" value="0" class="form-control consignment-tspin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="step">
                        <h4>Review Stock In/Out:</h4>
                        @if (isset($customer->catalogs))
                            @foreach ($customer->catalogs as $catalog)
                                <div id="product-{{ $catalog->id }}" class="row list-product">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div>{{ $catalog->product_code }} -
                                                        {{ $catalog->product->product_name }}</div>
                                                    <div class='total-consigned'>{{ $catalog->available_stock }}</div>

                                                </div>
                                                <div class="col-2 text-center">
                                                    <div class="btn btn-success btn-lg action-add" data-add="0">0</div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <div class="btn btn-danger btn-lg action-remove" data-remove="0">0
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
                                <p>If the stock already done maintained.</p>
                                <p>Click on the submit button to continue.</p>
                            </div>
                        </div>
                    </div>
                    <div id="success">
                        <div class="mt-5">
                            <h4>Success! We'll get back to you ASAP!</h4>
                            <p>Thank you!</p>
                            <a class="back-link" href="">Go back from the beginning ➜</a>
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
            step: 0.1
        });
        $("input[name='qty_stock_in']").TouchSpin({
            verticalbuttons: 0,
            buttondown_class: "btn btn-success",
            buttonup_class: "btn btn-success"
        });
        $("input[name='qty_stock_out']").TouchSpin({
            verticalbuttons: 0,
            buttondown_class: "btn btn-danger",
            buttonup_class: "btn btn-danger"
        });
    </script>
@endsection
