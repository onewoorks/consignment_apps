@extends('layouts.mob.master')

@section('title')
    @lang('translation.RegisterNewCustomer')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">@lang('translation.RegisterNewCustomer')</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Basic Information</h4>
                <p class="card-title-desc">Fill all information below</p>

                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="productname">Product Name</label>
                                <input id="productname" name="productname" type="text" class="form-control"
                                    placeholder="Product Name">
                            </div>
                            <div class="mb-3">
                                <label for="manufacturername">Manufacturer Name</label>
                                <input id="manufacturername" name="manufacturername" type="text" class="form-control"
                                    placeholder="Manufacturer Name">
                            </div>
                            <div class="mb-3">
                                <label for="manufacturerbrand">Manufacturer Brand</label>
                                <input id="manufacturerbrand" name="manufacturerbrand" type="text" class="form-control"
                                    placeholder="Manufacturer Brand">
                            </div>
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input id="price" name="price" type="text" class="form-control" placeholder="Price">
                            </div>

                            <div class="mb-3">
                                <label for="latitude">Latitude</label>
                                <input id="latitude" name="latitude" type="text" class="form-control text-center" placeholder="Longitude">
                            </div>

                            <div class="mb-3">
                                <label for="longitude">Logitude</label>
                                <input id="longitude" name="longitude" type="text" class="form-control text-center" 
                                placeholder="longitude">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="control-label">Category</label>
                                <select class="form-control select2">
                                    <option>Select</option>
                                    <option value="FA">Fashion</option>
                                    <option value="EL">Electronic</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Features</label>

                                <select class="select2 form-control select2-multiple" multiple="multiple"
                                    data-placeholder="Choose ...">
                                    <option value="WI">Wireless</option>
                                    <option value="BE">Battery life</option>
                                    <option value="BA">Bass</option>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="productdesc">Product Description</label>
                                <textarea class="form-control" id="productdesc" rows="5" placeholder="Product Description"></textarea>
                            </div>

                        </div>
                    </div>

                    <div id="c"></div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
<script type="text/javascript">
    var x = document.getElementById("demo");
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }
    
    function showPosition(position) {
    //   x.innerHTML = "Latitude: " + position.coords.latitude +
    //   "<br>Longitude: " + position.coords.longitude;
      $('#longitude').val(position.coords.longitude)
      $('#latitude').val(position.coords.latitude)
    }

    getLocation();
    </script>
@endsection
