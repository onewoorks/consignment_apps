@extends('layouts.mob.master')

@section('title')
    @lang('translation.RegisterNewCustomer')
@endsection

@section('css')
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
   integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
   crossorigin=""/>
   
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
                <h4 class="card-title">Customer Information</h4>
                <p class="card-title-desc">Fill all information below</p>
                <form>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="shopname">Shop Name</label>
                                <input id="shopname" name="shopname" type="text" class="form-control"
                                    placeholder="Shop Name">
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Region</label>
                                <select class="form-control select2">
                                    <option>Select</option>
                                    <option value="KT">Kuala Terengganu</option>
                                    <option value="DG">Dungun</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" rows="5" placeholder="Address"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="owner">Owner</label>
                                <input id="owner" name="owner" type="text" class="form-control" placeholder="Owner shop">
                            </div>

                            
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="phoneno">Phone Number</label>
                                <input id="phoneno" name="phoneno" type="text" class="form-control"
                                    placeholder="Phone No.">
                            </div>
                            <div id="map" style="height: 380px"></div>
                            <div class="row">
                                <label for="latitude">Geolocation</label>
                                <div class="col-sm-6">
                                    <div class="row mb-4">
                                        <label class="col-sm-3 col-form-label">Latitude</label>
                                        <div class="col-sm-9">
                                            <input id="latitude" name="latitude" type="text" class="form-control text-center"
                                                placeholder="Latitude">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row mb-4">
                                        <label class="col-sm-3 col-form-label">Longitude</label>
                                        <div class="col-sm-9">
                                            <input id="longitude" name="longitude" type="text" class="form-control text-center"
                                                placeholder="Longitude">
                                        </div>
                                    </div>
                                </div>
                                <p style="color:red;" id="geolocation"></p>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Shop Image</h4>
                    <p class="card-title-desc">
                    </p>
                    <div>
                        <form action="#" class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple="multiple">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                </div>
                                <h4>Drop files here or click to upload.</h4>
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-primary waves-effect waves-light">Send
                            Files</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>
<script type="text/javascript">

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
    </script>
@endsection
