@extends('layouts.web.master')

@section('title')
    @lang('translation.UpdateCustomer')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">@lang('translation.UpdateCustomer')</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Customer Information</h4>
                <p class="card-title-desc">Edit information below</p>
                <form id="form-customer" method="post" action="{{ url('/web/shop/update') }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="shop_id" id="shop_id" value="{{ $shop->id }}" />
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="shopname">Shop Name</label>
                                <input id="shopname" name="shopname" type="text" class="form-control"
                                    value="{{ $shop->shop_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Region</label>
                                <select id="region" name="region" class="form-control select2">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->branch_code }}"
                                            @if ($branch->branch_code === $shop->region) selected @endif>{{ $branch->branch_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" rows="5">{{ $shop->address }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="owner">Owner</label>
                                <input id="owner" name="owner" type="text" class="form-control"
                                    value="{{ $shop->owner }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="phoneno">Phone Number</label>
                                <input id="phoneno" name="phoneno" type="text" class="form-control"
                                    value="{{ $shop->phone_number }}">
                            </div>
                            <div id="map" style="height: 380px"></div>
                            <div class="row">
                                <label for="latitude">Geolocation</label>
                                <div class="col-sm-6">
                                    <div class="row mb-4">
                                        <label class="col-sm-3 col-form-label">Latitude</label>
                                        <div class="col-sm-9">
                                            <input id="latitude" name="latitude" type="text"
                                                class="form-control text-center" value="{{ $shop->latitude }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-4">
                                        <label class="col-sm-3 col-form-label">Longitude</label>
                                        <div class="col-sm-9">
                                            <input id="longitude" name="longitude" type="text"
                                                class="form-control text-center" value="{{ $shop->longitude }}">
                                        </div>
                                    </div>
                                </div>
                                <p style="color:red;" id="geolocation"></p>
                            </div>
                            <div id="c"></div>
                        </div>
                        <input type="hidden" name="shop_val" id="shop_val" value="Default" />
                        <input type="hidden" name="shop_name" id="shop_name" value="Default" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Shop Images</h4>
                    <form method="post" action="{{ url('/web/shop/upload') }}" enctype="multipart/form-data"
                        class="dropzone">
                        {{ csrf_field() }}
                        <div class="fallback"></div>
                        <div class="dz-default dz-message">
                            @if ($shop->shop_image != null)
                                <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
                                    <div class="dz-image">
                                        <img src="{{ URL::asset($shop->shop_image) }}" title="{{ $shop->shop_image }}" height="100"
                                            width="100">
                                    </div>
                                </div>
                            @else
                                <div class="mb-3">
                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                </div>
                                <h4>Drop files here or click to upload.</h4>
                            @endif

                        </div>
                    </form>
                </div>
            </div> <!-- end card-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" id="save-customer" class="btn btn-primary waves-effect waves-light">Save
                            Changes</button>
                        <button type="reset" id="reset-customer"
                            class="btn btn-secondary waves-effect waves-light">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- dropzone plugin -->
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script type="text/javascript">
        var x = document.getElementById('c');
        var csrf = $("input[name=_token]").val();

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            $('#longitude').val(position.coords.longitude)
            $('#latitude').val(position.coords.latitude)

            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
                .bindPopup('This is your location.')
                .openPopup();
        }

        getLocation();

        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone(".dropzone", {
            maxFilesize: 20,
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: true,
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-progress').hide();
                    document.getElementById('shop_name').value = file.name;
                    document.getElementById('shop_val').value = dataUrl;
                });

                this.on("removedfile", function(file) {
                    document.getElementById('shop_name').value = 'Removed';
                    document.getElementById('shop_val').value = 'Removed';
                });

            },
            removedfile: function(file) {
                var filename = file.name;

                $.ajax({
                    type: 'POST',
                    url: '{{ url('web/shop/upload/delete') }}',
                    data: {
                        '_token': csrf,
                        filename,
                    },
                    sucess: function(data) {
                        console.log('success: ' + data);
                    }
                });

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) :
                    void 0;
            }
        });

        $('#save-customer').on('click', function() {
            $('#form-customer').submit();
        });
    </script>
@endsection
